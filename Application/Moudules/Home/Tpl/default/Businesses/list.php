<include file="Public:header" />

<style>
     .my-page .ui-listview .ui-li-heading {
            white-space: nowrap;
        }
</style>

        <div data-role="content" class="my-page">
            
                    <ul data-role="listview" data-inset="true" id="list">
                    <foreach name="list" item="val">
                        <li>
                            <a class="ui-link-inherit" href="/Businesses/show/id/{$val.id}" data-transition="slidefade" data-inline="true">
                            <img src="{$val.logo}">
                            <h2>{$val.title}</h2>
                            </a>
                        </li>
                    </foreach>
                    </ul>
                
            <div style="clear:both"></div>
            
        </div>
        
<include file="Public:footer" />
