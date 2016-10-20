<?php
/**
 * Created by PhpStorm.
 * Date: 8/24/16
 * Time: 16:07
 */

namespace app\components;
use Yii;
use yii\web\UrlRule;

class Redirect301UrlRule extends UrlRule
{
    public $headers = [];
    public function createUrl($manager, $route, $params)
    {
        // Parse_ONLY
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $result = parent::parseRequest($manager, $request);

        if ($result) {
            $params = array_merge($result[1],array_filter($_GET));


            if (isset(Yii::$app->params['urlParamsConvert']) && ($arrParams = (array)Yii::$app->params['urlParamsConvert']) && isset($arrParams[$params[0]])){
                $paramsToConvert = $arrParams[$params[0]];

                foreach ($paramsToConvert as $from=>$to) {
                    if (isset($params[$from])){

                        if ($to && !isset($params[$to])){
                            $params[$from] = $params[$to];
                        }
                        unset($params[$from]);
                    }
                }

            }

            if (isset($params['det'])) {
                $params['vanity_name'] = $params['det'];
                unset($params['det']);
            }

            if ($result) {
                if(!empty($this->headers)) {
                    foreach($this->headers as $key=>$header) {
                        if(!Yii::$app->response->headers->has($key)) {
                            Yii::$app->response->headers->add($key,$header);
                        }
                    }
                }
                Yii::$app->response->redirect(array_merge([$result[0]],$params),301);
                Yii::$app->end();
            }

        }

        return $result;
    }
}