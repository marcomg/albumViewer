{include file='header.tpl'}
<div class="container">
<h1>View album {$title}</h1>
{section name=n loop=$photosPatch}
<a href="{$phothosUrl[n]}"><img class="img-rounded" src="{$smarty.const.URL}/{thumb file="{$photosPatch[n]}" width="150" link="false" html='class="img-rounded"' cache="cache/public/" getcachefilename=True}" /></a>
{sectionelse}
<p>The album is empty</p>
{/section}
<p><a href="#" class="btn" onclick="window.history.back(); return false;"><i class="icon-arrow-left"></i> Back</a></p>
</div>
{include file='footer.tpl'}