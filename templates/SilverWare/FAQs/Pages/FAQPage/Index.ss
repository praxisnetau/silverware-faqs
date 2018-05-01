<% if $HasFAQs %>
  <div class="index">
    <ol>
      <% loop $FAQs %>
        <li><a class="faq-index" href="$getFAQLink($Up.LinkMode)">$MenuTitle</a></li>
      <% end_loop %>
    </ol>
  </div>
<% end_if %>
