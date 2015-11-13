<?php


class PayInClient extends SMoneyClient
{
    protected $version = 2;

    public function getPayIns($UserId)
    {
        if ($UserId != null) {
            $Url = 'users/'.$UserId.'/payins/';
        } else {
            $Url = 'payins/';
        }

        return $this->getObjectList('PayIn', $Url);
    }

    public function getPayInCards($UserId, $page=null, $perpage=null)
    {
        $pagination = http_build_query(array('page' => $page, 'perpage' => $perpage));
        if ($UserId != null) {
            $Url = 'users/'.$UserId.'/payins/cardpayments?'.$pagination;
        } else {
            $Url = 'payins/cardpayments?'.$pagination;
        }

        return $this->getObjectList('PayInCard', $Url);
    }

    public function getPayInCard($UserId, $Id)
    {
        if ($UserId != null) {
            $Url = 'users/'.$UserId.'/payins/cardpayments/'.$Id;
        } else {
            $Url = 'payins/cardpayments/'.$Id;
        }

        return $this->getObject('PayInCard', $Url);
    }

    public function postPayInCard($payInCard, $UserId)
    {
        if ($UserId != null) {
            $Url = 'users/'.$UserId.'/payins/cardpayments';
        } else {
            $Url = 'payins/cardpayments';
        }

        return $this->postObject($payInCard, $Url);
    }
}
