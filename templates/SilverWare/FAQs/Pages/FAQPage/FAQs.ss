<% if $ShowFAQs %>
  <div class="categories faqs">
    <% loop $VisibleCategories %>
      <section class="category">
        <header>
          <h3>$Title</h3>
        </header>
        <% include SilverWare\FAQs\Pages\FAQCategory\FAQs HeadingLevel='h4' %>
      </section>
    <% end_loop %>
  </div>
<% end_if %>
