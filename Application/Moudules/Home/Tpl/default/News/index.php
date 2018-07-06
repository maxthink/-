<include file="Public:header" />

    <style>
        .ui-li .ui-li-desc {
            overflow: visible;
            white-space: normal;
        }
    </style>

        <div data-role="content">
            
            <ul data-role="listview" data-inset="true" id="list">

              <foreach name="list" item="val">
                <li>
                    <h2><a href="/news/show/id/{$val.id}">{$val.title}</a></h2>
                    <p>{$val.content|msubstr=0,300}</p>
                    <p class="ui-li-aside">{$val.create_time}</p>
                </li>
              </foreach>
                
            </ul>

            
            <div data-role="controlgroup" data-type="horizontal" style='margin-top: 25px;' data-mini="true">
                {$page}
            </div>
        </div>

<include file="Public:footer" />
