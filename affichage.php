<?php
require_once 'check_auth.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des CVs</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #2d3748;
      min-height: 100vh;
      padding: 40px 20px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      background-attachment: fixed;
    }

    .container {
      width: 100%;
      max-width: 1000px;
      background: #ffffff;
      border-radius: 16px;
      padding: 48px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
      animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      text-align: center;
      font-size: 2.2em;
      margin-bottom: 12px;
      font-weight: 700;
      color: #1a202c;
      letter-spacing: -0.5px;
    }

    .subtitle {
      text-align: center;
      color: #718096;
      margin-bottom: 40px;
      font-size: 1.05em;
    }

    /* Back Button */
    .back-btn {
      display: inline-flex;
      align-items: center;
      padding: 10px 20px;
      color: #667eea;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 600;
      margin-bottom: 24px;
      transition: all 0.3s;
      border: 2px solid #e2e8f0;
      background: #ffffff;
      font-size: 14px;
    }

    .back-btn:hover {
      background: #667eea;
      color: white;
      border-color: #667eea;
      transform: translateX(-4px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    /* CV List Container */
    .cv-list {
      margin-top: 24px;
    }

    .cv-list h2 {
      color: #2d3748;
      margin-bottom: 24px;
      font-size: 1.4em;
      font-weight: 600;
      padding-bottom: 12px;
      border-bottom: 3px solid #667eea;
    }

    .cv-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #ffffff;
      padding: 24px;
      margin-bottom: 16px;
      border-radius: 12px;
      border: 2px solid #e2e8f0;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease;
      position: relative;
    }

    .cv-item:hover {
      transform: translateY(-2px);
      border-color: #667eea;
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.15);
      background: #f8fafc;
    }

    .cv-info-compact {
      flex: 1;
    }

    .cv-name {
      font-size: 1.25em;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 6px;
      transition: color 0.3s ease;
    }

    .cv-item:hover .cv-name {
      color: #667eea;
    }

    .cv-meta {
      font-size: 0.9em;
      color: #718096;
      transition: color 0.3s ease;
    }

    .cv-item:hover .cv-meta {
      color: #4a5568;
    }

    .cv-actions {
      display: flex;
      gap: 12px;
    }

    /* Buttons */
    .btn {
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
    }

    .btn-view {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-view:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
    }

    .btn-view:active {
      transform: translateY(0);
    }

    .btn-delete {
      background-color: #ffffff;
      color: #e53e3e;
      border: 2px solid #e53e3e;
      transition: all 0.3s ease;
    }

    .btn-delete:hover {
      background-color: #e53e3e;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(229, 62, 62, 0.3);
    }

    .btn-delete:active {
      transform: translateY(0);
    }

    .loading, .no-cvs {
      text-align: center;
      color: #718096;
      font-size: 1.1em;
      margin-top: 60px;
      background: #f7fafc;
      padding: 40px;
      border-radius: 12px;
      border: 2px dashed #cbd5e0;
    }

    .error {
      background: #fed7d7;
      color: #c53030;
      padding: 20px;
      border-radius: 12px;
      text-align: center;
      margin-top: 20px;
      font-weight: 500;
      border: 1px solid #fc8181;
    }

    .total-count {
      text-align: center;
      color: #2d3748;
      font-size: 1em;
      margin-bottom: 24px;
      background: #edf2f7;
      padding: 14px;
      border-radius: 10px;
      border: 1px solid #e2e8f0;
      font-weight: 600;
    }

    .total-count::before {
      content: "";
      margin-right: 6px;
    }

    /* Empty State */
    .no-cvs {
      font-size: 1.1em;
      color: #4a5568;
    }

    .no-cvs::before {
      content: "";
      display: block;
      font-size: 3em;
      margin-bottom: 16px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        padding: 32px 24px;
      }

      h1 {
        font-size: 1.8em;
      }

      .cv-item {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
      }

      .cv-actions {
        width: 100%;
        justify-content: stretch;
      }

      .btn {
        flex: 1;
      }
    }
    .hamza{
      color : blue;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="first.php" class="back-btn">Retour</a>
    <h1 class='hamza'>Mes CV</h1>
    <p class="subtitle">Gérez et consultez tous vos CV créés</p>
    
    <div id="loading" class="loading">Chargement des CV...</div>
    <div class="total-count" id="total-count" style="display: none;"></div>
    <div id="cv-container"></div>
  </div>

<script>
    window.addEventListener('DOMContentLoaded', loadCVs);

    function loadCVs() {
        fetch('get_cvs.php')
            .then(response => response.json())
            .then(data => {
                const loading = document.getElementById('loading');
                const container = document.getElementById('cv-container');
                const totalCount = document.getElementById('total-count');
                
                loading.style.display = 'none';

                if (data.success && data.cvs.length > 0) {
                    totalCount.style.display = 'block';
                    const totalCVs = data.total || data.cvs.length; 
                    totalCount.textContent = `${totalCVs} CV${totalCVs > 1 ? 's' : ''} trouvé${totalCVs > 1 ? 's' : ''}`;

                    const listDiv = document.createElement('div');
                    listDiv.className = 'cv-list';

                    const title = document.createElement('h2');
                    title.textContent = 'Liste de vos CV';
                    listDiv.appendChild(title);

                    data.cvs.forEach(cv => {
                        const item = createCVItem(cv);
                        listDiv.appendChild(item);
                    });

                    container.appendChild(listDiv);
                } else {
                    container.innerHTML = '<div class="no-cvs">Aucun CV trouvé<br><small>Créez votre premier CV pour commencer</small></div>';
                }
            })
            .catch(error => {
                document.getElementById('loading').style.display = 'none';
                document.getElementById('cv-container').innerHTML = 
                    '<div class="error">❌ Erreur de connexion: ' + error.message + '</div>';
            });
    }

    function createCVItem(cv) {
        const item = document.createElement('div');
        item.className = 'cv-item';
        
        const date = new Date(cv.created_at);
        const dateStr = date.toLocaleDateString('fr-FR', {
            year: 'numeric', month: 'long', day: 'numeric'
        });

        item.innerHTML = `
            <div class="cv-info-compact">
                <div class="cv-name">${cv.nom}</div>
                <div class="cv-meta">Créé le ${dateStr}</div>
            </div>
            <div class="cv-actions">
                <a href="view_cv.php?id=${cv.id}" class="btn btn-view">Voir le CV</a>
                <button class="btn btn-delete" data-id="${cv.id}">Supprimer</button>
            </div>
        `;
        
        const deleteBtn = item.querySelector('.btn-delete');
        deleteBtn.addEventListener('click', () => {
            if (confirm(`Êtes-vous sûr de vouloir supprimer le CV de '${cv.nom}' ?\n\nCette action est irréversible.`)) {
                deleteCV(cv.id, item); 
            }
        });

        return item;
    }

    function deleteCV(cvId, cvItemElement) {
        const formData = new FormData();
        formData.append('cv_id', cvId);

        fetch('delete_cv.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                cvItemElement.style.transition = 'all 0.3s ease';
                cvItemElement.style.opacity = '0';
                cvItemElement.style.transform = 'translateX(-20px)';
                
                setTimeout(() => {
                    cvItemElement.remove();
                    
                    const totalCountElement = document.getElementById('total-count');
                    let currentText = totalCountElement.textContent; 
                    const match = currentText.match(/\d+/);
                    let currentCount = match ? parseInt(match[0]) : 0;

                    if (currentCount > 0) {
                        let newCount = currentCount - 1;
                        totalCountElement.textContent = `${newCount} CV${newCount > 1 ? 's' : ''} trouvé${newCount > 1 ? 's' : ''}`;

                        if (newCount === 0) {
                            totalCountElement.style.display = 'none';
                            document.getElementById('cv-container').innerHTML = '<div class="no-cvs">Aucun CV trouvé<br><small>Créez votre premier CV pour commencer</small></div>';
                        }
                    }
                }, 300);
                
                alert('✓ CV supprimé avec succès');
            } else {
                alert('❌ Erreur lors de la suppression: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('❌ Une erreur s\'est produite. Veuillez réessayer.');
        });
    }
</script>
</body>
</html>