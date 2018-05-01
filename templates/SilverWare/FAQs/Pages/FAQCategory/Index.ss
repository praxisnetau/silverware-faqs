<% if $HasFAQs %>
  <% include SilverWare\FAQs\Pages\FAQPage\Index LinkMode='anchor' %>
<% else %>
  <% include Alert Type='warning', Text=$NoDataMessage %>
<% end_if %>
