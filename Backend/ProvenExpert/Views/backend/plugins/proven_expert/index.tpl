{extends file="parent:frontend/index/index.tpl"}

{block name="frontend_index_footer_container" prepend}
    {if $pe_seal_landing_bottom}
        <style>
            .pe_landing_bottom {
                margin-top:20px;
            }
        </style>
        <div class="pe_landing_bottom">{$pe_seal_landing_bottom}</div>
    {/if}
{/block}

{block name="frontend_index_shop_navigation" prepend}
    {if $pe_seal_logo}
        <style>
            .pe_logo {
                float:right;
                margin-bottom:10px;
            }
        </style>
        <div class="pe_logo">{$pe_seal_logo}</div>
    {/if}
{/block}

{block name="frontend_index_left_menu" prepend}
    {if $pe_seal_circle}
        <style>
            .pe_circle {
                margin-top:5%;
                margin-left:18%;
                margin-bottom:5%;
            }
        </style>
        <div class="pe_circle">{$pe_seal_circle}</div>
    {/if}
{/block}

{block name="frontend_index_left_menu" prepend}
    {if $pe_seal_portrait}
        <style>
            .pe_portrait {
                margin-top:5%;
                margin-left:12%;
                margin-bottom:5%;
            }
        </style>
        <div class="pe_portrait">{$pe_seal_portrait}</div>
    {/if}
{/block}

{block name="frontend_index_body_inline" prepend}
    {if $pe_richsnippet}
        <style>
            .pe_rs {
                text-align:center;
            }
        </style>
        <div class="pe_rs footer--logo">{$pe_richsnippet}</div>
    {/if}
{/block}

{block name="frontend_index_footer" prepend}
    {if $pe_seal_bar}
        <style>
            .pe_bar {

            }
        </style>
        <div class="pe_bar">{$pe_seal_bar}</div>
    {/if}
{/block}

{block name="frontend_index_body_inline" prepend}
    {if $pe_seal_filler}
        <div>{$pe_seal_filler}</div>
    {/if}
{/block}
