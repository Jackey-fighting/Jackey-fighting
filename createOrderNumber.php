/**
     * 生成订单编号
     * @return string
     */
    public static function getNumber()
    {
        $count = 1;
        while ($count != 0){
            $number = date('Ymdhi') . mt_rand(1000000,9999999).mt_rand(1000000,9999999);
            $count = OrderModel::where('number',$number)->count();
        }
        return $number;
    }
