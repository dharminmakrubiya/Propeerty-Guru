(function (api) {
  // Extends our custom "elegant-recipe-blog-upgrade" section.
  api.sectionConstructor["elegant-recipe-blog-upgrade"] = api.Section.extend({
    // No events for this type of section.
    attachEvents: function () {},

    // Always make the section active.
    isContextuallyActive: function () {
      return true;
    },
  });
})(wp.customize);
