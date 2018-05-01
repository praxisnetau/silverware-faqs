<% if $FAQs %>
  <div class="faqs">
    <% loop $FAQs %>
      <section id="$HTMLID" class="faq">
        <header>
          <{$Up.HeadingLevel}>$Title</{$Up.HeadingLevel}>
        </header>
        <div class="answer">
          $Content
        </div>
        <% if $FooterShown %>
          <footer>
            <% include Button Tag='a', ExtraClass='top', Icon=$TopIcon, Text=$TopText, HREF='#top' %>
          </footer>
        <% end_if %>
      </section>
    <% end_loop %>
  </div>
<% end_if %>
