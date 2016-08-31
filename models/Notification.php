<?php

namespace app\models;

use Yii;
use app\models\Monitoringchok;
use machour\yii2\notifications\models\Notification as BaseNotification;

class Notification extends BaseNotification
{
    const KEY_NEW_CASE = 'new_case_open';
    const KEY_CASE_REMINDER_EMAIL = 'case_email_send_date';
    const KEY_CASE_REMINDER_SF_RECEIPT_DATE = 'case_sf_receipt_date_set';
	const KEY_CASE_REMINDER_SF_ORIGINAL_RECEIPT_DATE = 'case_sf_original_receipt_date_set';
	const KEY_CASE_REMINDER_SF_DATE_FOR_COURT = 'case_sf_date_for_court';
    /**
     * @var array Holds all usable notifications
     */
    public static $keys = [
        self::KEY_NEW_CASE,
        self::KEY_CASE_REMINDER_EMAIL,
		self::KEY_CASE_REMINDER_SF_RECEIPT_DATE,
		self::KEY_CASE_REMINDER_SF_ORIGINAL_RECEIPT_DATE,
		self::KEY_CASE_REMINDER_SF_DATE_FOR_COURT,
    ];

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        switch ($this->key) {
            case self::KEY_NEW_CASE:
                return Yii::t('app', 'A new case open');
			case self::KEY_CASE_REMINDER_EMAIL:
                return Yii::t('app', 'DC office send an e-mail');
			case self::KEY_CASE_REMINDER_SF_RECEIPT_DATE:
                return Yii::t('app', 'DC office set SF receipt date');
            case self::KEY_CASE_REMINDER_SF_ORIGINAL_RECEIPT_DATE:
                return Yii::t('app', 'Upazila office set SF original receipt date');
			case self::KEY_CASE_REMINDER_SF_DATE_FOR_COURT:
                return Yii::t('app', 'DC office set SF date for court');
        }
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        switch ($this->key) {            
			case self::KEY_NEW_CASE:
                return Yii::t('app', 'Judge court open a new case');
			case self::KEY_CASE_REMINDER_EMAIL:
                return Yii::t('app', 'Check your e-mail to get the necessary information');
			case self::KEY_CASE_REMINDER_SF_RECEIPT_DATE:
                return Yii::t('app', 'DC office set SF receipt date');
            case self::KEY_CASE_REMINDER_SF_ORIGINAL_RECEIPT_DATE:
                return Yii::t('app', 'Upazila office set SF original receipt date');
			case self::KEY_CASE_REMINDER_SF_DATE_FOR_COURT:
                return Yii::t('app', 'DC office set SF date for court');
        }
    }

    /**
     * @inheritdoc
     */
    public function getRoute()
    {
        switch ($this->key) {
            case self::KEY_NEW_CASE:
                return ['/./monitoringchok/view', 'id' => $this->key_id];
			case self::KEY_CASE_REMINDER_EMAIL:
                return ['/./monitoringchok/view', 'id' => $this->key_id]; 
			case self::KEY_CASE_REMINDER_SF_RECEIPT_DATE:
                return ['/./monitoringchok/view', 'id' => $this->key_id]; 
			case self::KEY_CASE_REMINDER_SF_ORIGINAL_RECEIPT_DATE:
                return ['/./monitoringchok/view', 'id' => $this->key_id]; 
			case self::KEY_CASE_REMINDER_SF_DATE_FOR_COURT:
                return ['/./monitoringchok/view', 'id' => $this->key_id]; 
        };
    }

}