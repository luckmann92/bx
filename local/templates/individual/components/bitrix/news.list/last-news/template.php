<?if($arResult['ITEMS']){?>
    <div class="last__news-wrapper">
        <div class="sidebar__title">
            <h4>Новости</h4>
        </div>
        <?foreach($arResult['ITEMS'] as $arNews){
            $this->AddEditAction($arNews['ID'], $arNews['EDIT_LINK'], CIBlock::GetArrayByID($arNews["IBLOCK_ID"], "NEWS_EDIT"));
            $this->AddDeleteAction($arNews['ID'], $arNews['DELETE_LINK'], CIBlock::GetArrayByID($arNews["IBLOCK_ID"], "NEWS_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="last__news-item" id="<?=$this->GetEditAreaId($arNews['ID']); ?>">
                <span class="last__news-date"><?=$arNews['DISPLAY_ACTIVE_FROM'] ? $arNews['DISPLAY_ACTIVE_FROM'] : $arNews['ACTIVE_FROM']?></span>
                <a href="<?=$arNews['DETAIL_PAGE_URL']?>" class="last__news-name"><?=$arNews['NAME']?></a>
            </div>
        <?}?>
        <a href="/news/" class="btn btn-link">Все новости</a>
    </div>
<?}?>