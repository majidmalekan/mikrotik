<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Datepicker()
 * @method static self Text()
 * @method static self File()
 * @method static self Password()
 * @method static self Email()
 * @method static self Textarea()
 * @method static self Timepicker()
 * @method static self Range()
 * @method static self Checkbox()
 * @method static self Radiobutton()
 * @method static self Select()
 * @method static self Auto_complete()
 */
final class FormInputTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Datepicker' => lcfirst('Datepicker'),
            'Text' => lcfirst('Text'),
            'File' => lcfirst('File'),
            'Password' => lcfirst('Password'),
            'Email' => lcfirst('Email'),
            'Textarea' => lcfirst('Textarea'),
            'Timepicker' => lcfirst('Timepicker'),
            'Range' => lcfirst('Range'),
            'Checkbox' => lcfirst('Checkbox'),
            'Radiobutton' => lcfirst('Radiobutton'),
            'Select' => lcfirst('Select'),
            'Auto_complete' => lcfirst('Auto_complete'),
        ];
    }

    protected static function labels(): array
    {
        return [
            'Datepicker' => __('enums.form_input_type.Datepicker'),
            'Text' => __('enums.form_input_type.Text'),
            'File' => __('enums.form_input_type.File'),
            'Password' => __('enums.form_input_type.Password'),
            'Email' => __('enums.form_input_type.Email'),
            'Textarea' => __('enums.form_input_type.Textarea'),
            'Timepicker' => __('enums.form_input_type.Timepicker'),
            'Range' => __('enums.form_input_type.Range'),
            'Checkbox' => __('enums.form_input_type.Checkbox'),
            'Radiobutton' => __('enums.form_input_type.Radiobutton'),
            'Select' => __('enums.form_input_type.Select'),
            'Auto_complete' => __('enums.form_input_type.Auto_complete'),
        ];
    }
}
