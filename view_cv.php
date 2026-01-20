<?php
require_once 'check_auth.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Affichage CV</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f4f7fb;
      color: #333;
    }

    .back-btn {
      position: fixed;
      top: 20px;
      left: 20px;
      padding: 10px 20px;
      background: #667eea;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 600;
      z-index: 1000;
    }

    .print-btn {
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 10px 20px;
      background: #27ae60;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 600;
      z-index: 1000;
      border: none;
      cursor: pointer;
    }

    /* ==================== CV STYLE 1 (cv1) ==================== */
    .cv1 {
      max-width: 900px;
      margin: 30px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
      overflow: hidden;
    }

    .cv1 .cv-container {
      display: flex;
    }

    .cv1 .cv-left {
      width: 30%;
      background: linear-gradient(180deg, #2C5364, #203A43, #0F2027);
      color: #fff;
      padding: 25px 20px;
      text-align: center;
    }

    .cv1 .cv-left img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
      border: 3px solid #fff;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .cv1 .cv-left h3 {
      margin-top: 25px;
      border-bottom: 1px solid rgba(255,255,255,0.3);
      padding-bottom: 5px;
      font-size: 18px;
      text-transform: uppercase;
      color: #FFD700;
      letter-spacing: 1px;
    }

    .cv1 .cv-left ul {
      list-style: none;
      padding: 0;
      margin-top: 10px;
    }

    .cv1 .cv-left ul li {
      margin: 6px 0;
      color: #f1f1f1;
    }

    .cv1 .cv-right {
      width: 70%;
      padding: 35px;
      background: #fff;
    }

    .cv1 .cv-right h1 {
      margin: 0;
      font-size: 30px;
      color: #2C5364;
      letter-spacing: 1px;
      text-transform: uppercase;
      text-align: center;
    }

    .cv1 .cv-right h2 {
      margin-top: 25px;
      font-size: 20px;
      color: #203A43;
      border-bottom: 2px solid #ddd;
      padding-bottom: 5px;
    }

    .cv1 .contact-item {
      display: flex;
      align-items: center;
      margin: 8px 0;
    }

    #hh{
      word-wrap: break-word;
    }
    /* ==================== CV STYLE 2 (cv2) ==================== */
    .cv2 {
      max-width: 900px;
      margin: 30px auto;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 15px;
      padding: 3px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }

    .cv2 .cv-inner {
      background: white;
      border-radius: 13px;
      padding: 40px;
    }

    .cv2 .cv-header {
      text-align: center;
      padding: 30px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 10px;
      margin-bottom: 30px;
    }

    .cv2 .cv-header img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 5px solid white;
      margin-bottom: 15px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.3);
    }

    .cv2 .cv-header h1 {
      margin: 0;
      font-size: 35px;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    .cv2 .cv-section {
      margin: 25px 0;
    }

    .cv2 .cv-section h2 {
      color: #667eea;
      font-size: 24px;
      border-bottom: 3px solid #764ba2;
      padding-bottom: 8px;
      margin-bottom: 15px;
    }

    .cv2 .contact-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 15px;
      margin: 20px 0;
    }

    .cv2 .contact-box {
      background: #f8f9fa;
      padding: 15px;
      border-radius: 8px;
      border-left: 4px solid #667eea;
    }

    .cv2 .skill-tag {
      display: inline-block;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 8px 15px;
      border-radius: 20px;
      margin: 5px;
      font-size: 14px;
    }

    .cv2 ul {
      list-style: none;
      padding: 0;
    }

    .cv2 ul li {
      padding: 10px;
      margin: 8px 0;
      background: #f8f9fa;
      border-radius: 6px;
      border-left: 3px solid #667eea;
    }

    /* Common styles */
    .loading {
      text-align: center;
      padding: 100px;
      font-size: 1.5em;
      color: #667eea;
    }

    .error {
      background: #ff6b6b;
      color: white;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      margin: 50px auto;
      max-width: 600px;
    }
    .cv1 .contact-item .imag {
      width: 20px; 
      height: 20px;
      margin-right: 10px;
    }
    
    /* PRINT STYLES - Make printed version look exactly like screen */
    @media print {
      /* Hide buttons */
      .back-btn, .print-btn, .loading {
        display: none !important;
      }
      
      /* Reset body for print */
      body {
        background: white !important;
        color: #333 !important;
        margin: 0 !important;
        padding: 0 !important;
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
      }
      
      /* Force CV to take full page width */
      .cv1, .cv2 {
        box-shadow: none !important;
        margin: 0 !important;
        max-width: 100% !important;
        page-break-inside: avoid;
      }
      
      /* Preserve background colors and gradients in print */
      .cv1 .cv-left,
      .cv2,
      .cv2 .cv-header,
      .cv2 .skill-tag,
      .cv2 .contact-box,
      .cv2 ul li {
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
        background-origin: border-box !important;
      }
      
      /* Ensure proper sizing */
      .cv1 .cv-container {
        display: flex !important;
        flex-direction: row !important;
      }
      
      .cv1 .cv-left {
        width: 30% !important;
        padding: 25px 20px !important;
      }
      
      .cv1 .cv-right {
        width: 70% !important;
        padding: 35px !important;
      }
      
      /* Fix images */
      img {
        max-width: 100% !important;
        height: auto !important;
        -webkit-print-color-adjust: exact !important;
      }
      
      /* Ensure text doesn't break awkwardly */
      h1, h2, h3, p, ul, li {
        page-break-inside: avoid;
        orphans: 3;
        widows: 3;
      }
      
      /* Force background printing (some browsers ignore this by default) */
      * {
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
      }
    }
  </style>
</head>
<body>
  <a href="affichage.php" class="back-btn"> Retour à la liste</a>
  <button onclick="window.print()" class="print-btn"> Imprimer </button>
  
  <div id="loading" class="loading">Chargement du CV...</div>
  <div id="cv-display"></div>

  <script>
    // Récupérer l'ID du CV depuis l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const cvId = urlParams.get('id');

    if (!cvId) {
      document.getElementById('loading').innerHTML = '<div class="error">Aucun CV sélectionné</div>';
    } else {
      loadCV(cvId);
    }

    function loadCV(id) {
      fetch('get_cvs.php?id=' + id) 
        .then(response => response.json())
        .then(data => {
          document.getElementById('loading').style.display = 'none';
          
          if (data.success) {
            displayCV(data.cv);
          } else {
            document.getElementById('cv-display').innerHTML = 
              '<div class="error">Erreur: ' + data.message + '</div>';
          }
        })
        .catch(error => {
          document.getElementById('loading').style.display = 'none';
          document.getElementById('cv-display').innerHTML = 
            '<div class="error">Erreur de connexion: ' + error.message + '</div>';
        });
    }

    function displayCV(cv) {
      const container = document.getElementById('cv-display');
      
      if (cv.design === 'cv1') {
        container.innerHTML = generateCV1(cv);
      } else {
        container.innerHTML = generateCV2(cv);
      }
    }

    function generateCV1(cv) {
      const languesList = cv.langues.map(l => `<li>${l.langue_name} (${l.niveau})</li>`).join('');
      const loisirsList = (cv.loisirs && cv.loisirs.length > 0) ? cv.loisirs.split(',').map(l => `<li>${l.trim()}</li>`).join('') : '';
      const skillsList = (cv.skills && cv.skills.length > 0) ? cv.skills.split(',').map(s => `<li>${s.trim()}</li>`).join('') : '';
      const certificatsList = (cv.certificats && cv.certificats.length > 0) ? cv.certificats.split(',').map(c => `<li>${c.trim()}</li>`).join('') : '';
      
      return `
        <div class="cv1">
          <div class="cv-container">
            <div class="cv-left">
              ${cv.photo ? `<img src="${cv.photo}" alt="Photo">` : '<img src="images/default.jpg" alt="Photo">'}
              
              <h3>Contact</h3>
              <div class="contact-item">
              <img  class="imag" src="email.png">
                <span> ${cv.email}</span>
              </div>
              <div class="contact-item">
              <img  class="imag" src="tele.png">
                <span> ${cv.telephone}</span>
              </div>
              <div class="contact-item">
              <img  class="imag" src="adres.png">
                <span> ${cv.adresse}</span>
              </div>

              <h3>Langues</h3>
              <ul>
                ${languesList}
              </ul>

              <h3>Loisirs</h3>
              <ul>
                ${loisirsList}
              </ul>

              <h3>Compétences</h3>
              <ul>
                ${skillsList}
              </ul>
            </div>

            <div class="cv-right">
              <h1>${cv.nom}</h1>
              <br><br>

              <h3>Description</h3>
              <p id="hh">${cv.description}</p>

              <h2>Diplômes</h2>
              <ul>
                ${cv.diplomes.map(d => `<li><strong>${d.name}</strong><br>${d.start_date} → ${d.end_date}</li>`).join('')}
              </ul>

              <h2>Expériences</h2>
              <ul>
                ${cv.experiences.map(e => `<li><strong>${e.entreprise}</strong><br><span style="word-wrap: break-word; word-break: break-word; overflow-wrap: break-word; display: block; white-space: normal;">${e.description}</span><br><em>${e.start_date} → ${e.end_date}</em></li>`).join('')}
              </ul>

              <h2>Certificats</h2>
              <ul>
                ${certificatsList}
              </ul>
            </div>
          </div>
        </div>
      `;
    }

    function generateCV2(cv) {
      const languesTags = cv.langues.map(l => `<span class="skill-tag">${l.langue_name} (${l.niveau})</span>`).join('');
      const skillsTags = (cv.skills && cv.skills.length > 0) ? cv.skills.split(',').map(s => `<span class="skill-tag">${s.trim()}</span>`).join('') : '';
      const loisirsTags = (cv.loisirs && cv.loisirs.length > 0) ? cv.loisirs.split(',').map(l => `<span class="skill-tag">${l.trim()}</span>`).join('') : '';
      const certificatsList = (cv.certificats && cv.certificats.length > 0) ? cv.certificats.split(',').map(c => `<li>${c.trim()}</li>`).join('') : '';

      return `
        <div class="cv2">
          <div class="cv-inner">
            <div class="cv-header">
              ${cv.photo ? `<img src="${cv.photo}" alt="Photo">` : ''}
              <h1>${cv.nom}</h1>
            </div>

            <div class="cv-section">
              <h2> Contact</h2>
              <div class="contact-grid">
                <div class="contact-box">
                  <strong>Email:</strong><br>${cv.email}
                </div>
                <div class="contact-box">
                  <strong>Téléphone:</strong><br>${cv.telephone}
                </div>
                <div class="contact-box">
                  <strong>Adresse:</strong><br>${cv.adresse}
                </div>
              </div>
            </div>

            <div class="cv-section">
              <h2> Description</h2>
              <p id="hh">${cv.description}</p>
            </div>

            <div class="cv-section">
              <h2> Diplômes</h2>
              <ul>
                ${cv.diplomes.map(d => `<li><strong>${d.name}</strong><br>${d.start_date} → ${d.end_date}</li>`).join('')}
              </ul>
            </div>

            <div class="cv-section">
              <h2> Expériences</h2>
              <ul>
                ${cv.experiences.map(e => `<li><strong>${e.entreprise || 'N/A'}</strong><br><span style="word-wrap: break-word; word-break: break-word; overflow-wrap: break-word; display: block; white-space: normal;">${e.description || 'N/A'}</span><br><em>${e.start_date} → ${e.end_date}</em></li>`).join('')}              </ul>
            </div>

            <div class="cv-section">
              <h2> Certificats</h2>
              <ul>
                ${certificatsList}
              </ul>
            </div>

            <div class="cv-section">
              <h2> Langues</h2>
              <div>
                ${languesTags}
              </div>
            </div>

            <div class="cv-section">
              <h2> Loisirs</h2>
              <div>
                ${loisirsTags}
              </div>
            </div>

            <div class="cv-section">
              <h2> Compétences</h2>
              <div>
                ${skillsTags}
              </div>
            </div>
          </div>
        </div>
      `;
    }
  </script>
</body>
</html>