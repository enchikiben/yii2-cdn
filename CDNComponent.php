<?php

namespace enchikiben\cdn;

use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\View;
use yii\helpers\Html;

class CDNComponent extends Component implements BootstrapInterface
{
    public $enabled = true;

    public $domains = [];

    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            $app->view->on(View::EVENT_END_PAGE, function (Event $e) use ($app) {
                /**
                 * @var $view View
                 */
                $view = $e->sender;

                if ($this->enabled && $view instanceof View && $app->response->format == Response::FORMAT_HTML && !$app->request->isAjax) {
                    if (!empty($this->domains)) {
                        foreach ($view->jsFiles as $pos => $files) {
                            if (!empty($files)) {
                                foreach ($files as $file => $jsFile) {
                                    if (Url::isRelative($file)) {
                                        $randDomainKey = array_rand($this->domains);
                                        $view->jsFiles[$pos][$file] = Html::jsFile($this->domains[$randDomainKey] . $file);
                                    }
                                }
                            }
                        }
                        foreach ($view->cssFiles as $file => $jsFile) {
                            if (Url::isRelative($file)) {
                                $randDomainKey = array_rand($this->domains);
                                $view->cssFiles[$file] = Html::cssFile($this->domains[$randDomainKey] . $file);
                            }
                        }
                    }
                }
            });
        }
    }
}