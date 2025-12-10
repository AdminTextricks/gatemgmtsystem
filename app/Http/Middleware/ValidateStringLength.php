<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidateStringLength
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $exclude = [
            'description',
            'desc',
            'message',
            'recipient_ids',
            'curriculum',
            'allergies',
            'vocational_and_skill_training',
            'special_achievements',
            'additional_info',
            'individual_educational_plan',
            'p_address',
            'c_address',
            'address',
            'classification',
            'teacher_remarks',
            'principal_remarks',
            'pen_picture',
            'curriculum_goal',
            'material_required',
            'reject_reason',
            'remarks',
            'reason',
            'error_message',
            'short_description',
        ];

        foreach ($request->all() as $key => $value) {
           
            if (in_array($key, $exclude)) {
                continue;
            }
           
            if (is_string($value) && strlen($value) > 255) {
                // Create a validator instance
                $validator = Validator::make(
                    [$key => $value],
                    [$key => 'max:255'],
                    ["{$key}.max" => "The Value may not be greater than 255 characters."]
                );
                // If validation fails, return normal redirect with errors
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        return $next($request);
    }
}
