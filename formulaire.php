<?php
require_once 'check_auth.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Créateur de CV Professionnel</title>
<style>
 
* { 
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

    body {
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      min-height: 100vh;
      padding: 40px 20px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      background-attachment: fixed;
      overflow-x: hidden;
    }

.container {
    background: #ffffff;
    border-radius: 16px;
    padding: 48px;
    width: 100%;
    max-width: 650px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    animation: slideIn 0.4s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.header {
    text-align: center;
    margin-bottom: 40px;
}

.header h2 {
    font-size: 32px;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 8px;
}

.header p {
    color: #718096;
    font-size: 15px;
}

.form-group {
    margin-bottom: 24px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #2d3748;
    font-size: 14px;
}

.form-control {
    width: 100%;
    padding: 14px 16px;
    border-radius: 10px;
    border: 2px solid #e2e8f0;
    outline: none;
    background: #ffffff;
    color: #2d3748;
    font-size: 15px;
    font-family: 'Inter', sans-serif;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.04);
}

.form-control:focus {
    border-color: #667eea;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.form-control::placeholder {
    color: #a0aec0;
    font-weight: 400;
}

.form-control:disabled {
    background: #f7fafc;
    color: #a0aec0;
    cursor: not-allowed;
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
    line-height: 1.5;
}

input[type="file"].form-control {
    padding: 12px;
    background: #f8fafc;
    cursor: pointer;
    border: 2px dashed #cbd5e0;
}

input[type="file"].form-control:hover {
    border-color: #667eea;
    background: #f0f4f8;
}

input[type="file"].form-control:focus {
    border-style: solid;
}

.exp-item .form-control {
    background: #ffffff;
    border: 2px solid #e2e8f0;
    margin-bottom: 16px;
}

.exp-item .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.exp-item label {
    display: block;
    margin-bottom: 6px;
    margin-top: 0;
    font-size: 13px;
    color: #4a5568;
    font-weight: 600;
    text-transform: none;
    letter-spacing: 0.3px;
}

.exp-item label:first-child {
    margin-top: 0;
}

.section-divider {
    border: none;
    height: 1px;
    background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
    margin: 32px 0;
}

.dynamic-section {
    margin-bottom: 32px;
}

.section-title {
    display: block;
    margin-bottom: 20px;
    font-weight: 700;
    color: #1a202c;
    font-size: 18px;
    padding-bottom: 10px;
    border-bottom: 3px solid #667eea;
}

.exp-item {
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
    padding: 24px;
    border-radius: 12px;
    margin-bottom: 20px;
    border: 2px solid #e2e8f0;
    position: relative;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.exp-item:hover {
    border-color: #667eea;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    transform: translateY(-2px);
}

.btn-remove {
    background: #fc8181;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 8px;
    transition: all 0.3s ease;
    width: auto;
}

.btn-remove:hover {
    background: #f56565;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(245, 101, 101, 0.3);
}

.btn-add {
    background: #48bb78;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    width: 100%;
    transition: all 0.3s ease;
    margin-top: 8px;
    box-shadow: 0 2px 6px rgba(72, 187, 120, 0.3);
}

.btn-add:hover {
    background: #38a169;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(72, 187, 120, 0.4);
}

.design-section {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 24px;
    margin-top: 24px;
    background: #f8fafc;
}

.design-section legend {
    font-weight: 600;
    color: #2d3748;
    font-size: 16px;
    padding: 0 12px;
}

.design-option {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
    padding: 16px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}

.design-option:hover {
    border-color: #667eea;
    background: #f7fafc;
    transform: translateY(-1px);
}

.design-option input[type="radio"] {
    margin-right: 12px;
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: #667eea;
}

.design-option span {
    flex: 1;
    font-weight: 500;
    color: #2d3748;
}

.design-option img {
    width: 100px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
}

.button-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-top: 32px;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 16px 24px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

.btn-primary:active {
    transform: translateY(0);
}

.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.btn-secondary {
    background: #ffffff;
    color: #667eea;
    border: 2px solid #667eea;
    padding: 16px 24px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
}

.modal.active {
    display: flex;
}

.modal-content {
    background: white;
    padding: 40px;
    border-radius: 16px;
    text-align: center;
    max-width: 400px;
    width: 90%;
    animation: modalSlide 0.3s ease-out;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

@keyframes modalSlide {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.success-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #48bb78, #38a169);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    font-size: 40px;
    color: white;
    box-shadow: 0 8px 20px rgba(72, 187, 120, 0.4);
}

.modal-content h3 {
    font-size: 24px;
    margin-bottom: 12px;
    color: #1a202c;
}

.modal-content p {
    color: #718096;
    margin-bottom: 24px;
    line-height: 1.5;
}

#c2WarningModal {
    display: none; 
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

#c2WarningModal.active {
    display: flex;
}

.warning-icon {
    font-size: 3em;
    color: #ffc107;
    margin-bottom: 10px;
}

.modal-actions {
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
    width: 100%;
}

.modal-actions button {
    width: 45%;
}

@media (max-width: 768px) {
    .container {
        padding: 32px 24px;
        margin: 20px;
    }
    
    .header h2 {
        font-size: 26px;
    }
    
    .button-group {
        grid-template-columns: 1fr;
    }
}
/* Word wrap for descriptions and list items */
#hh {
  word-wrap: break-word;
  word-break: break-word;
  overflow-wrap: break-word;
  white-space: normal;
}

.cv1 .cv-right ul li {
  word-wrap: break-word;
  word-break: break-word;
  overflow-wrap: break-word;
  white-space: normal;
}

.cv2 ul li {
  word-wrap: break-word;
  word-break: break-word;
  overflow-wrap: break-word;
  white-space: normal;
}

</style>
</head>
<body>

<div class="container">
  <div class="header">
    <h2>Créateur de CV</h2>
    <p>Remplissez vos informations pour créer votre CV professionnel</p>
  </div>

  <form id="cvForm">
    <div class="form-group">
      <label for="nom">Nom et Prénom *</label>
      <input type="text" id="nom" class="form-control" placeholder="Ex: Hamza Ourziki" required>
    </div>

    <div class="form-group">
      <label for="cv-photo">Photo de profil *</label>
      <input type="file" id="cv-photo" class="form-control" accept="image/*" required>
    </div>

    <div class="form-group">
      <label for="email">Email *</label>
      <input type="email" id="email" class="form-control" placeholder="email@example.com" required>
    </div>

    <div class="form-group">
      <label for="telephone">Téléphone *</label>
      <input type="tel" id="telephone" class="form-control" placeholder="0612345678" required>
    </div>

    <div class="form-group">
      <label for="adresse">Adresse *</label>
      <input type="text" id="adresse" class="form-control" placeholder="Nador, Rue 4" required>
    </div>

    <div class="form-group">
      <label for="description">Description *</label>
      <textarea id="description" class="form-control" placeholder="Parlez de vous..." required></textarea>
    </div>

    <hr class="section-divider">

    <div class="dynamic-section">
      <span class="section-title">📚 Diplômes *</span>
      <div id="diplome-section">
        <div class="exp-item">
          <label>Nom du diplôme *</label>
          <input type="text" name="diplome-name[]" class="form-control" placeholder="Ex: Licence en Informatique" required>
          <label>Date de début *</label>
          <input type="date" name="diplome-start[]" class="form-control" required>
          <label>Date de fin</label>
          <input type="date" name="diplome-end[]" class="form-control" placeholder="Date de fin">
          <button type="button" class="btn-remove removeDiplome">Supprimer</button>
        </div>
        <button type="button" id="adddiplome" class="btn-add"> Ajouter un diplôme</button>
      </div>
    </div>

    <hr class="section-divider">

    <div class="dynamic-section">
      <span class="section-title">💼 Expériences Professionnelles *</span>
      <div id="experience-section">
        <div class="exp-item">
          <label>Entreprise *</label>
          <input type="text" name="entreprise[]" class="form-control" placeholder="Ex: Google Inc." required>
          <label>Description du poste *</label>
          <textarea name="description[]" class="form-control" placeholder="Décrivez vos responsabilités et réalisations..." required></textarea>
          <label>Date de début *</label>
          <input type="date" name="periodefirst[]" class="form-control" required>
          <label>Date de fin</label>
          <input type="date" name="periodeend[]" class="form-control" placeholder="Date de fin">
          <button type="button" class="btn-remove removeExp">Supprimer</button>
        </div>
        <button type="button" id="addExperience" class="btn-add"> Ajouter une expérience</button>
      </div>
    </div>

    <hr class="section-divider">

    <div class="dynamic-section">
      <span class="section-title">🗣️ Langues</span>
      <div id="langues-section">
        <div class="exp-item">
          <label>Langue *</label>
          <input type="text" name="langue-name[]" class="form-control" placeholder="Ex: Français" required>
          <label>Niveau *</label>
          <select name="langue-niveau[]" class="form-control" required>
            <option value="" disabled selected>Sélectionnez un niveau</option>
            <option value="A1">A1 (Débutant)</option>
            <option value="A2">A2 (Intermédiaire)</option>
            <option value="B1">B1 (Seuil)</option>
            <option value="B2">B2 (Avancé)</option>
            <option value="C1">C1 (Autonome)</option>
            <option value="C2">C2 (Maîtrise)</option>
          </select>
          <button type="button" class="btn-remove removeLangue">Supprimer</button>
        </div>
        <button type="button" id="addLangue" class="btn-add"> Ajouter une langue</button>
      </div>
    </div>

    <hr class="section-divider">

    <div class="form-group">
      <label for="certificats">Certificats</label>
      <input type="text" id="certificats" class="form-control" placeholder="Ex: Certification AWS">
    </div>

    <div class="form-group">
      <label for="loisirs">Loisirs</label>
      <input type="text" id="loisirs" class="form-control" placeholder="Ex: Sport, Lecture, Voyages">
    </div>

    <div class="form-group">
      <label for="skills">Compétences</label>
      <input type="text" id="skills" class="form-control" placeholder="Ex: HTML, CSS, JavaScript">
    </div>

    <fieldset class="design-section">
      <legend>Choisissez un design *</legend>
      <label class="design-option">
        <input type="radio" name="design" value="cv1">
        <span>CV Style 1 - Moderne</span>
        <img src="cv2.PNG" alt="Style 1">
      </label>
      <label class="design-option">
        <input type="radio" name="design" value="cv2" checked>
        <span>CV Style 2 - Classique</span>
        <img src="cv3.PNG" alt="Style 2">
      </label>
    </fieldset>

    <div class="button-group">
      <button type="button" id="btn" class="btn-secondary">Retour</button>
      <button type="submit" id="generer" class="btn-primary">Enregistrer le CV</button>
    </div>
  </form>
</div>

<!-- Modal de succès -->
<div class="modal" id="successModal">
  <div class="modal-content">
    <div class="success-icon">✓</div>
    <h3>CV enregistré !</h3>
    <p>Votre CV a été créé avec succès.</p>
    <button class="btn-primary" onclick="window.location.href='affichage.php'">Voir mes CVs</button>
  </div>
</div>

<!-- Modal d'avertissement C2 -->
<div class="modal" id="c2WarningModal">
    <div class="modal-content">
        <div class="warning-icon">⚠️</div>
        <h3>Confirmer le niveau C2</h3>
        <p>Ce niveau est tres eleve. Êtes-vous sur de votre selection ?</p>
        <div class="modal-actions">
            <button type="button" class="btn-secondary" id="cancelC2">Annuler</button>
            <button type="button" class="btn-primary" id="confirmC2">OK</button>
        </div>
    </div>
</div>

<script>
  let currentLangueSelect = null;

// Écouteur pour détecter la sélection de C2 IMMÉDIATEMENT
document.addEventListener('change', function(e) {
    if (e.target.matches('#langues-section select[name="langue-niveau[]"]')) {
        const selectElement = e.target;
        
        if (selectElement.value === 'C2') {
            // Stocker la référence à l'élément
            currentLangueSelect = selectElement; 
            
            // Afficher le modal C2
            document.getElementById('c2WarningModal').classList.add('active');
        }
    }
});

// Bouton 'Annuler' du modal
document.getElementById('cancelC2').addEventListener('click', function() {
    if (currentLangueSelect) {
        currentLangueSelect.value = ""; 
    }
    document.getElementById('c2WarningModal').classList.remove('active');
    currentLangueSelect = null;
});

// Bouton 'OK' du modal
document.getElementById('confirmC2').addEventListener('click', function() {
    document.getElementById('c2WarningModal').classList.remove('active');
    currentLangueSelect = null;
});
window.onload = function () {
  var photoBase64 = '';

  var inputFile = document.getElementById('cv-photo');
  if (inputFile) {
    inputFile.addEventListener('change', function () {
      var file = this.files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
          photoBase64 = e.target.result;
          console.log("✅ Photo chargée");
        }
        reader.readAsDataURL(file);
      }
    });
  }

  document.getElementById("adddiplome").addEventListener("click", function () {
    let section = document.getElementById("diplome-section");
    let wrapper = document.createElement("div");
    wrapper.className = "exp-item";

    wrapper.innerHTML = `
      <label>Nom du diplôme *</label>
      <input type="text" name="diplome-name[]" class="form-control" required placeholder="Ex: Master en Développement Web">
      <label>Date de début *</label>
      <input type="date" name="diplome-start[]" class="form-control" required>
      <label>Date de fin</label>
      <input type="date" name="diplome-end[]" class="form-control" placeholder="Date de fin">
      <button type="button" class="btn-remove removeDiplome">Supprimer</button>
    `;

    wrapper.querySelector(".removeDiplome").addEventListener("click", function () {
      wrapper.remove();
    });

    section.insertBefore(wrapper, this);
  });

  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('removeDiplome')) {
      e.target.closest('.exp-item').remove();
    }
  });

  document.getElementById("addLangue").addEventListener("click", function () {
    let section = document.getElementById("langues-section");
    let wrapper = document.createElement("div");
    wrapper.className = "exp-item";

    wrapper.innerHTML = `
      <label>Langue *</label>
      <input type="text" name="langue-name[]" class="form-control" placeholder="Ex: Anglais" required>
      <label>Niveau *</label>
      <select name="langue-niveau[]" class="form-control" required>
        <option value="" disabled selected>Sélectionnez un niveau</option>
        <option value="A1">A1 (Débutant)</option>
        <option value="A2">A2 (Intermédiaire)</option>
        <option value="B1">B1 (Seuil)</option>
        <option value="B2">B2 (Avancé)</option>
        <option value="C1">C1 (Autonome)</option>
        <option value="C2">C2 (Maîtrise)</option>
      </select>
      <button type="button" class="btn-remove removeLangue">Supprimer</button>
    `;

    wrapper.querySelector(".removeLangue").addEventListener("click", function () {
      wrapper.remove();
    });

    section.insertBefore(wrapper, this);
  });

  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('removeLangue')) {
      e.target.closest('.exp-item').remove();
    }
  });

  document.getElementById("addExperience").addEventListener("click", function () {
    let section = document.getElementById("experience-section");
    let wrapper = document.createElement("div");
    wrapper.className = "exp-item";

    wrapper.innerHTML = `
      <label>Entreprise *</label>
      <input type="text" name="entreprise[]" class="form-control" required placeholder="Ex: Microsoft Corporation">
      <label>Description du poste *</label>
      <textarea name="description[]" class="form-control" required placeholder="Décrivez vos missions et accomplissements..."></textarea>
      <label>Date de début *</label>
      <input type="date" name="periodefirst[]" class="form-control" required>
      <label>Date de fin</label>
      <input type="date" name="periodeend[]" class="form-control">
      <button type="button" class="btn-remove removeExp">Supprimer</button>
    `;

    wrapper.querySelector(".removeExp").addEventListener("click", function () {
      wrapper.remove();
    });

    section.insertBefore(wrapper, this);
  });

  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('removeExp')) {
      e.target.closest('.exp-item').remove();
    }
  });

  document.getElementById("cvForm").addEventListener("submit", (e) => {
    e.preventDefault();

    let btnGenerer = document.getElementById("generer");
    btnGenerer.disabled = true;
    btnGenerer.textContent = "Enregistrement...";

    let selectedDesign = document.querySelector('input[name="design"]:checked');
    if (!selectedDesign) {
      alert("Veuillez choisir un design de CV !");
      btnGenerer.disabled = false;
      btnGenerer.textContent = "Enregistrer le CV";
      return;
    }

    let diplomeItems = document.querySelectorAll("#diplome-section .exp-item");
    let diplomes = [];
    diplomeItems.forEach((item) => {
      let name = item.querySelector('input[name="diplome-name[]"]');
      let start = item.querySelector('input[name="diplome-start[]"]');
      let end = item.querySelector('input[name="diplome-end[]"]');
      if (name && start && name.value.trim() && start.value) {
        let endValue = end && end.value ? end.value : new Date().toISOString().split('T')[0];
        diplomes.push({
          name: name.value.trim(),
          start: start.value,
          end: endValue
        });
      }
    });

    let experienceItems = document.querySelectorAll("#experience-section .exp-item");
    let experiences = [];
    experienceItems.forEach((item) => {
      let entreprise = item.querySelector('input[name="entreprise[]"]');
      let description = item.querySelector('textarea[name="description[]"]');
      let start = item.querySelector('input[name="periodefirst[]"]');
      let end = item.querySelector('input[name="periodeend[]"]');
      if (entreprise && description && start && 
          entreprise.value.trim() && description.value.trim() && start.value) {
        let endValue = end && end.value ? end.value : new Date().toISOString().split('T')[0];
        experiences.push({
          entreprise: entreprise.value.trim(),
          description: description.value.trim(),
          start: start.value,
          end: endValue
        });
      }
    });
    
    let langueItems = document.querySelectorAll("#langues-section .exp-item");
    let langues = [];
    langueItems.forEach((item) => {
      let name = item.querySelector('input[name="langue-name[]"]');
      let niveau = item.querySelector('select[name="langue-niveau[]"]');
      if (name && niveau && name.value.trim() && niveau.value) {
        langues.push({
          name: name.value.trim(),
          niveau: niveau.value
        });
      }
    });

    var data = {
      nom: document.getElementById("nom").value.trim(),
      photo: photoBase64 || '',
      email: document.getElementById("email").value.trim(),
      telephone: document.getElementById("telephone").value.trim(),
      adresse: document.getElementById("adresse").value.trim(),
      description: document.getElementById("description").value.trim(),
      diplomes: diplomes,
      experiences: experiences,
      certificats: document.getElementById("certificats").value.trim(),
      langues: langues, 
      loisirs: document.getElementById("loisirs").value.trim(),
      skills: document.getElementById("skills").value.trim(),
      design: selectedDesign.value
    };

    let allInputs = document.querySelectorAll("input[required], textarea[required]");
    let emptyFields = [];
    allInputs.forEach(input => {
      if (!input.value.trim()) {
        emptyFields.push(input.placeholder || input.name);
      }
    });

    if (emptyFields.length > 0) {
      alert("❌ Veuillez remplir tous les champs obligatoires :\n\n" + emptyFields.join(", "));
      btnGenerer.disabled = false;
      btnGenerer.textContent = "Enregistrer le CV";
      return;
    }

    if (!photoBase64) {
      alert("❌ Veuillez ajouter une photo de profil !");
      btnGenerer.disabled = false;
      btnGenerer.textContent = "Enregistrer le CV";
      return;
    }

    const apiUrl = 'save_cv.php';
    fetch(apiUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
    .then(response => response.text())
    .then(text => {
      try {
        return JSON.parse(text);
      } catch (e) {
        console.error("❌ JSON Parse Error:", e);
        console.error("Response:", text);
        throw new Error('Invalid JSON response');
      }
    })
    .then(result => {
      btnGenerer.disabled = false;
      btnGenerer.textContent = "Enregistrer le CV";

      if (result.success) {
        document.getElementById('successModal').classList.add('active');
        setTimeout(() => {
          window.location.href = 'affichage.php';
        }, 2000);
      } else {
        alert("❌ Erreur: " + result.message);
      }
    })
    .catch(error => {
      console.error("❌ Error:", error);
      btnGenerer.disabled = false;
      btnGenerer.textContent = "Enregistrer le CV";
      alert("❌ Erreur: " + error.message);
    });
  });

  document.getElementById('btn').addEventListener('click', function() {
    history.back();
  });
};

</script>
</body>
</html>