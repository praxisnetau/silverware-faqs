<% if $VisibleCategories %>
  <div class="categories index">
    <% loop $VisibleCategories %>
      <section class="category">
        <header id="$HTMLID">
          <h3>$Title</h3>
        </header>
        <% include SilverWare\FAQs\Pages\FAQPage\Index LinkMode=$Up.LinkMode %>
      </section>
    <% end_loop %>
  </div>
<% else %>
  <% include Alert Type='warning', Text=$NoDataMessage %>
<% end_if %>
