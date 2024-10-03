<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self VerifyProfile()
 * @method static self VerifyBankAccount()
 * @method static self VerifyOfficialGazette()
 * @method static self VerifyUndertaking()
 * @method static self VerifyArticleOfAssociation()
 * @method static self VerifySignatory()
 * @method static self NationalCard()
 * @method static self BankAccount()
 * @method static self MediaAuthorization()
 * @method static self Guild()
 * @method static self CanTransfer()
 */
final class VerifyStateEnum extends Enum
{
    /**
     * @return string[]
     */
    protected static function values(): array
    {
        return [
            'VerifyProfile' => 'verify_profile',
            'VerifyBankAccount' => 'verify_bank_account',
            'VerifyOfficialGazette' => 'verify_official_gazette',
            'VerifyUndertaking' => 'verify_undertaking',
            'VerifyArticleOfAssociation' => 'verify_article_of_association',
            'VerifySignatory' => 'verify_signatory',
            'NationalCard' => 'national_card',
            'BankAccount' => 'bank_account',
            'MediaAuthorization' => 'media_authorization',
            'Guild' => 'guild',
            'CanTransfer' => 'can_transfer',
        ];
    }

    /**
     * @return string[]
     */
    protected static function labels(): array
    {
        return [
            'VerifyProfile' => __('enums.verify_state.VerifyProfile'),
            'VerifyBankAccount' => __('enums.verify_state.VerifyBankAccount'),
            'VerifyOfficialGazette' => __('enums.verify_state.VerifyOfficialGazette'),
            'VerifyUndertaking' => __('enums.verify_state.VerifyUndertaking'),
            'VerifyArticleOfAssociation' => __('enums.verify_state.VerifyArticleOfAssociation'),
            'VerifySignatory' => __('enums.verify_state.VerifySignatory'),
            'NationalCard' => __('enums.verify_state.NationalCard'),
            'BankAccount' => __('enums.verify_state.BankAccount'),
            'MediaAuthorization' => __('enums.verify_state.MediaAuthorization'),
            'Guild' => __('enums.verify_state.Guild'),
            'CanTransfer' => __('enums.verify_state.CanTransfer'),
        ];
    }
}
