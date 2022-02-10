[{$smarty.block.parent}]
<tr>
    <td class="edittext" colspan="2">
        <br/>
        <fieldset title="[{oxmultilang ident="CATEGORY_MEDIA_PROPERTIES_MEDIAURLS"}]" style="padding-left: 5px;">
            <legend>[{oxmultilang ident="CATEGORY_MEDIA_PROPERTIES_MEDIAURLS"}]</legend>
            <br>
            <table cellspacing="0" cellpadding="0" border="0">
                [{block name="admin_CATEGORY_MEDIA_PROPERTIES_media"}]

                [{foreach from=$aMediaUrls item=oMediaUrl}]
                <tr>
                    [{if $oddclass == 2}]
                    [{assign var=oddclass value=""}]
                    [{else}]
                    [{assign var=oddclass value="2"}]
                    [{/if}]
                    <td  style="min-width: 450px;"  class=listitem[{$oddclass}]>
                        &nbsp;<a href="[{$oMediaUrl->getLink()}]" target="_blank">
                            [{$oMediaUrl->oxmediaurls__oxdesc->value}] </a>&nbsp;
                    </td>
                    <td class=listitem[{$oddclass}]>
                        <a
                                href="[{$oViewConf->getSelfLink()}]&cl=category_main&amp;mediaid=[{$oMediaUrl->oxmediaurls__oxid->value}]&amp;fnc=deleteMedia&amp;oxid=[{$oxid}]&amp;editlanguage=[{$editlanguage}]"
                                onClick='return confirm("[{oxmultilang ident="GENERAL_YOUWANTTODELETE"}]")'
                        >
                            <img src="[{$oViewConf->getImageUrl()}]/delete_button.gif" border=0>
                        </a>&nbsp;
                    </td>
                </tr>
                [{/foreach}]
            </table>
        </fieldset>
        <fieldset style="padding-left: 5px;">
            <legend>[{oxmultilang ident="CATEGORY_MEDIA_PROPERTIES_UPDATEMEDIA"}]</legend>
            <br>

            <table>
                <tr>
                    <td colspan="3">
                        [{oxmultilang ident="CATEGORY_MEDIA_PROPERTIES_DESCRIPTION"}]:<br>
                        <input style="width:100%" type="text" name="mediaDesc" class="edittext" [{$readonly}]>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <br/>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        [{oxmultilang ident="CATEGORY_MEDIA_PROPERTIES_ENTERURL"}]:<br>
                        <input style="width:100%" type="text" name="mediaUrl" class="edittext" [{$readonly}]>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        [{oxmultilang ident="CATEGORY_MEDIA_PROPERTIES_UPLOADFILE"}]:<br>
                        <input style="width:100%" type="file" name="mediaFile" class="edittext" [{$readonly}]>
                    </td>
                </tr>
                [{/block}]
            </table>
        </fieldset>
    </td>
</tr>
