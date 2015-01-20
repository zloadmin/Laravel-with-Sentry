<?php



class HomeController extends \BaseController
{

    public function index()
    {
        return View::make('home.index');
    }
    public function getRegister()
    {
        return View::make('home.register');
    }

    public function getLogin()
    {
        return View::make('home.login');
    }

    public function getProfile()
    {
        return View::make('home.profile');
    }

    public function getReset()
    {
        return View::make('home.reset');
    }

    public function getResetCode($id, $code)
    {
        $view = View::make('home.resetcode');

        try {
            $user = Sentry::findUserById($id);
            $view->with('id', $id);
            $view->with('code', $code);
            $view->with('email', $user->email);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::to('reset-error');
        }
        return $view;
    }

    public function postRegister()
    {

        $rules = [
            'fio' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:8|same:password2',
            'password2' => 'required',
        ];

        $messages = array(
            'fio.required' => 'Не указано ФИО',
            'email.required' => 'Не указано Email',
            'email.email' => 'Email указан невернно',
            'email.unique' => 'Данный Email уже есть в системе',
            'phone.required' => 'Не указано Телефон',
            'phone.unique' => 'Данный Телефон уже есть в системе',
            'password.required' => 'Не указан пароль',
            'password.min' => 'Пароль должен быть не менее 8 символов',
            'password.same' => 'Пароли не совпадают',
            'password2.required' => 'Не указано потверждение паролья',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $error = [];

        $user = array(
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'fio' => Input::get('fio'),
            'phone' => Input::get('phone'),
            'managername' => Input::get('managername'),
            'activated' => true,
        );

        try {
            $reg = Sentry::register($user);

            $userGroup = Sentry::findGroupByName('User');

            $reg->addGroup($userGroup);

        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $error[] = 'Login field is required.';
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $error[] = 'Password field is required.';
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            $error[] = 'User with this email already exists.';
        }

        try {
            $auth = Sentry::authenticate($user, false);
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $error[] = 'Login field is required.';
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $error[] = 'Password field is required.';
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            $error[] = 'Wrong password, try again.';
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $error[] = 'User was not found.';
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            $error[] = 'User is not activated.';
        } // The following is only required if the throttling is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            $error[] = 'User is suspended.';
        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            $error[] = 'User is banned.';
        }

        if ($error) return Redirect::back()->withErrors($error)->withInput();

        return Redirect::to('/');

    }


    public function postLogin()
    {

        $errors = [];
        try {
            // Login credentials
            $credentials = array(
                'email' => Input::get('email'),
                'password' => Input::get('password'),
            );

            // Authenticate the user
            $user = Sentry::authenticate($credentials, false);
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $errors[] = 'Не введен Email адресс';
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $errors[] = 'Не введен пароль';
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            $errors[] = 'Введен неверно пароль';
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $errors[] = 'Данного пользовател не существует';
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            $errors[] = 'Пользователь не активирован';
        } // The following is only required if the throttling is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            $errors[] = 'User is suspended.';
        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            $errors[] = 'User is banned.';
        }

        if ($errors) return Redirect::back()->withErrors($errors)->withInput();

        return Redirect::to('/');
    }


    public function postProfile()
    {
        $userid = Sentry::getUser()->id;
        $errors = [];

        $rules = [
            'fio' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ];
        $messages = array(
            'fio.required' => 'Не указано ФИО',
            'email.required' => 'Не указано Email',
            'phone.required' => 'Не указано Телефон',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        try
        {
            // Find the user using the user id
            $user = Sentry::findUserById($userid);

            // Update the user details
            $user->fio = Input::get('fio');
            $user->email = Input::get('email');
            $user->phone = Input::get('phone');
            $user->address = Input::get('address');

            // Update the user
            if ($user->save())
            {
                return Redirect::back()->with('status', 'ok_update');
            }
            else
            {
                return Redirect::back()->with('status', 'errror_update');
            }
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $errors[] ='Данный Email занят';
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $errors[] ='User was not found.';
        }
        if ($errors) return Redirect::back()->withErrors($errors);

    }


    public function postReset()
    {

        $rules = [
            'email' => 'required|email|exists:users,email',
        ];

        $messages = array(
            'email.required' => 'Не указано Email',
            'email.email' => 'Email указан невернно',
            'email.exists' => 'Данный Email не найден в системе',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $email = Input::get('email');
        try
        {
            // Find the user using the user email address
            $user = Sentry::findUserByLogin($email);

            // Get the password reset code
            $resetCode = $user->getResetPasswordCode();

            $recoverUrl = URL::to('reset') . '/' . $user->id . '/' . $resetCode;
            $fullName = $user->fio;
            $data = array('email' => $user->email, 'name' => $fullName, 'recoverUrl' => $recoverUrl);

            $send = Mail::send('home.email', $data, function($message) use($data) {
                $message->to($data['email'], $data['name'])->subject('Laravel password reset');
            });
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Redirect::back()->withErrors(array('Данный Email не найден в системе.'))->withInput();
        }

        return Redirect::back()->with(['send' => 'Письмо с паролем отправлено на почту']);


    }

    public function postResetCode($id, $code)
    {

        $rules = [
            'password' => 'required|min:8|same:password2',
            'password2' => 'required',
        ];

        $messages = array(
            'password.required' => 'Не указан пароль',
            'password.min' => 'Пароль должен быть не менее 8 символов',
            'password.same' => 'Пароли не совпадают',
            'password2.required' => 'Не указано потверждение паролья',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try {

            $password = Input::get('password');

            // Find the user using the user id
            $user = Sentry::findUserById($id);

            // Check if the reset password code is valid
            if ($user->checkResetPasswordCode($code)){

                // Attempt to reset the user password
                if ($user->attemptResetPassword($code, $password)) {

                    $credentials = array(
                        'email'    => $user->email,
                        'password' => $password,
                    );

                    // Authenticate the user
                    Sentry::authenticate($credentials, false);

                    return Redirect::to('/');

                } else { // Password reset failed
                    return Redirect::to('reset-error');
                }
            } else { // The provided password reset code is Invalid
                return Redirect::to('reset-error');
            }
        } catch(Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::to('reset-error');
        }

        return Redirect::to('login');
    }

    public function logout()
    {
        Sentry::logout();
        return Redirect::to('/');
    }

    public function error()
    {
        return View::make('home.reset-error');
    }

}