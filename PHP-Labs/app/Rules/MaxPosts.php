<?php

namespace App\Rules;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxPosts implements ValidationRule
{
    protected $userId;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    public function __toString()
    {
        return (string) $this->userId;
    }
    public function passes($attribute, $value)
    {
        $postCount = Post::where('user_id', $this->userId)->count();
        return $postCount < 3;
    }
    public function message()
    {
        return 'You have exceeded the maximum number of allowed posts.';
    }
}