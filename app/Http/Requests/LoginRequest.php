<?php

namespace App\Http\Requests;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email" => ["required", "string", "email"],
            "password" => ["required", "string"]
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (!Auth::attempt($this->only("email", "password"), $this->boolean("remember"))) {

            RateLimiter::hit($this->throttleKey());

            throw new HttpResponseException(
                response()->json([
                    "status" => false,
                    "data" => null,
                    "message" => "These credentials do not match our records.",
                    "code" => 401
                ], 401)
            );
        }

        RateLimiter::clear($this->throttleKey());
    }

    protected function failedValidation(Validator $validator)
    {
        $messages = implode("\n", $validator->errors()->all());

        $response = response()->json([
            "status" => false,
            "data" => null,
            "message" => $messages,
            "code" => 422
        ], 422);

        throw new ValidationException($validator, $response);
    }

    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) return;

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            "email" => trans("auth.throttle", [
                "seconds" => $seconds,
                "minutes" => ceil($seconds / 60),
            ])
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }
}
