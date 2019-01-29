<?php
/**
 * @author Danil Syromolotov <ds@itex.ru>
 */
/**
 * @var array $arParams
 */
global $APPLICATION;
$VISITOR_ID = $APPLICATION->get_cookie("confirm_fz152");

if (empty($arParams["VALUE"]) || $APPLICATION->get_cookie("confirm_fz152") == 'y') {
    return;
}

?>
<script type="text/javascript">
    <?=$VISITOR_ID;?>
    fz152Module.init("<p><?= $arParams["VALUE"]; ?></p>");
    fz152Module.run("<?= $APPLICATION->GetCurDir(); ?>?CONFIRM_FZ152=Y", "/blank.html");
</script>
