<table id="active_membership" class="display">
<thead>
<tr>
    <th>{ts}Start Date{/ts}</th>
    <th>{ts}End Date{/ts}</th>
</tr>
</thead>
{foreach from=$periods item=activeMember}
<tr>
    <td class="crm-membership-start_date" data-order="{$activeMember.start_date}">{$activeMember.start_date|crmDate}</td>
    <td class="crm-membership-end_date" data-order="{$activeMember.end_date}">{$activeMember.end_date|crmDate}</td>
</tr>
{/foreach}
</table>

