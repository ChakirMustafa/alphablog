document.addEventListener('DOMContentLoaded', () => {
  const navToggle = document.querySelector('[data-nav-toggle]');
  const siteNav = document.querySelector('[data-site-nav]');

  if (navToggle && siteNav) {
    navToggle.addEventListener('click', () => {
      const isOpen = siteNav.classList.toggle('is-open');
      navToggle.setAttribute('aria-expanded', String(isOpen));
    });

    siteNav.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => {
        siteNav.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  const searchInput = document.querySelector('[data-story-search]');
  if (searchInput) {
    const stories = Array.from(document.querySelectorAll('[data-story-item]'));
    const noResults = document.querySelector('[data-no-results]');
    const count = document.querySelector('[data-search-count]');

    const filterStories = () => {
      const query = searchInput.value.trim().toLowerCase();
      let visible = 0;

      stories.forEach((story) => {
        const matches = (story.dataset.storyText || '').includes(query);
        story.hidden = !matches;
        if (matches) visible += 1;
      });

      if (noResults) noResults.classList.toggle('is-visible', visible === 0);
      if (count) {
        count.textContent = query ? `Showing ${visible} of ${stories.length} stories` : '';
      }
    };

    searchInput.addEventListener('input', filterStories);
  }

  document.querySelectorAll('[data-character-input]').forEach((input) => {
    const output = input.closest('.field')?.querySelector('[data-character-count]');
    if (!output) return;

    const updateCount = () => {
      output.textContent = String(input.value.length);
    };

    input.addEventListener('input', updateCount);
    updateCount();
  });

  document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
      if (!window.confirm(form.dataset.confirm)) event.preventDefault();
    });
  });

  const shareButton = document.querySelector('[data-share]');
  const shareStatus = document.querySelector('[data-share-status]');
  if (shareButton && shareStatus) {
    shareButton.addEventListener('click', async () => {
      const shareData = {
        title: document.title,
        url: window.location.href,
      };

      try {
        if (navigator.share) {
          await navigator.share(shareData);
          shareStatus.textContent = 'Thanks for sharing.';
        } else if (navigator.clipboard) {
          await navigator.clipboard.writeText(shareData.url);
          shareStatus.textContent = 'Link copied to clipboard.';
        } else {
          shareStatus.textContent = shareData.url;
        }
      } catch (error) {
        if (error.name !== 'AbortError') shareStatus.textContent = 'Could not share this link.';
      }
    });
  }
});
