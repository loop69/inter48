<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title =  Yii::t('app', 'NAV_ABOUT');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       Комментарии через аккаунты в соц.сетях. Добавляем комменты, не стесняемсо!
    </p>


</div>
<div id="hypercomments_widget"></div>
<script type="text/javascript">
    _hcwp = window._hcwp || [];
    _hcwp.push({widget:"Stream", widget_id: 70960});
    (function() {
        if("HC_LOAD_INIT" in window)return;
        HC_LOAD_INIT = true;
        var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "en").substr(0, 2).toLowerCase();
        var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true;
        hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://w.hypercomments.com/widget/hc/70960/"+lang+"/widget.js";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hcc, s.nextSibling);
        })();
    </script>
<a href="http://hypercomments.com" class="hc-link" title="comments widget">comments powered by HyperComments</a>

<!--
<div id="hypercomments_widget"></div>
<script type="text/javascript">
    _hcwp = window._hcwp || [];
    _hcwp.push({widget:"Stream", widget_id: 70960});
    (function() {
        if("HC_LOAD_INIT" in window)return;
        HC_LOAD_INIT = true;
        var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "en").substr(0, 2).toLowerCase();
        var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true;
        hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://w.hypercomments.com/widget/hc/70960/"+lang+"/widget.js";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hcc, s.nextSibling);
    })();
</script>
<a href="http://hypercomments.com" class="hc-link" title="comments widget">comments powered by HyperComments</a>
-->