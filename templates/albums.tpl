{include file='header.tpl'}
<div class="container">
<h1>{$title}</h1>
{section name=n loop=$albums}
<p><a href="{$albumsUrl[n]}">{$albums[n]}</a></p>
{sectionelse}
<p>No album</p>
{/section}
</div>
{include file='footer.tpl'}