<table id="membership" class="display">
<thead>
<tr>
    <th>{ts}Start Date{/ts}</th>
    <th>{ts}End Date{/ts}</th>
    <th>Contribution amount</th>
    <th></th>
</tr>
</thead>
{foreach name=outer item=period from=$periods}
  <tr>
  {foreach key=key item=item from=$period}
    {if $key == 'start_date'}
      <td class="crm-membership-start_date" data-order="{$item}">{$item}</td>
    {elseif $key == 'end_date'}
      <td class="crm-membership-end_date" data-order="{$item}">{$item}</td>
    {elseif $key == 'contribution_id.total_amount'}
      <td class="contriTotalLeft right">{$item|crmMoney}</td>
    {/if}
  {/foreach}
  <td><a href="/civicrm/contact/view/contribution?reset=1&id={$period.contribution_id}&action=view">{ts}view{/ts}</td>
</tr>
{/foreach}
</table>
