document.addEventListener('DOMContentLoaded', () => {

  const basePath = './'; // depuis pochon.html, partial est un sous-dossier

  const loadPartial = (id, file) => {
    fetch(basePath + file)
      .then(res => {
        if (!res.ok) throw new Error(`Erreur HTTP: ${res.status}`);
        return res.text();
      })
      .then(html => {
        const el = document.getElementById(id);
        if (el) el.innerHTML = html;
      })
      .catch(err => console.error(`Erreur lors du chargement de ${file}:`, err));
  };

  loadPartial('site-header', 'partial/header.html');
  loadPartial('site-nav', 'partial/nav.html');
  loadPartial('site-cta', 'partial/cta.html');
  loadPartial('site-footer', 'partial/footer.html');

});
