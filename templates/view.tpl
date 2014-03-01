{include file='header.tpl'}
<div class="container">
<h1>View photo {$title}</h1>
<p><a href="#" class="btn" onclick="window.history.back(); return false;"><i class="icon-arrow-left"></i> Back</a></p>
<img class="img-rounded" src="{$smarty.const.URL}/{$photoPatch}"/>
</div>
{include file='footer.tpl'}