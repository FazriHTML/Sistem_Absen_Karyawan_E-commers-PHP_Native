// Updated show.js dengan sistem perhitungan berdasarkan kategori

// Konfigurasi untuk aplikasi
const CONFIG = window.CONFIG || {
  productPrice: 50000,
  category: "brosur",
  categorySlug: "brosur", // Tambahkan categorySlug
  pricingConfig: {},
  productName: "Produk",
  whatsappNumber: "6282130779827",
  csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || "{{ csrf_token() }}",
  productCheckoutUrl: '{{ route("products.checkout-product") }}',
  calculatorCheckoutUrl: '{{ route("products.checkout-calculator") }}',
  images: [], // Pastikan images ada
};

// Initialize the application when DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
  initializeLoadingOverlay();
  initializeGallery();
  initializeTabs();
  initializeEventListeners();
  initializeAnimations();
  calculateProductTotal();
  setupCategorySpecificUI(); // Pindahkan ke sini agar dijalankan setelah semua inisialisasi
});

function setupCategorySpecificUI() {
  const categorySlug = CONFIG.categorySlug || CONFIG.category;
  const calculatorOptions = document.querySelector(".calculator-options");

  if (calculatorOptions) {
    // Clear existing options
    calculatorOptions.innerHTML = "";

    // Generate options based on category
    switch (categorySlug) {
      case "banner":
        setupBannerOptions(calculatorOptions);
        break;
      case "bannerflexi":
      case "banner_flexi":
        setupBannerFlexiOptions(calculatorOptions);
        break;
      case "brosur":
        setupBrosurOptions(calculatorOptions);
        break;
      case "sticker":
        setupStickerOptions(calculatorOptions);
        break;
      case "kartu_nama":
        setupKartuNamaOptions(calculatorOptions);
        break;
      case "aksesoris":
        setupAksesorisOptions(calculatorOptions);
        break;
      default:
        setupBrosurOptions(calculatorOptions); // Default
    }

    // Re-attach event listeners
    attachCalculatorEventListeners();

    // Calculate price after UI setup
    setTimeout(() => {
      calculateCalculatorPrice();
    }, 100);
  }
}

function setupBannerOptions(container) {
  container.innerHTML = `
        <div class="calculator-row">
            <label class="calculator-label">📊 Jumlah</label>
            <input type="number" class="form-input" id="quantity" value="1" min="1" max="1000">
            <span style="margin-top: 5px; font-size: 0.9rem; margin-left: 10px;">pcs</span>
        </div>
        
        <div class="calculator-row">
            <label class="calculator-label">📏 Ukuran</label>
            <select class="form-select" id="size">
                <option value="2x1m">2x1 meter (2 m²)</option>
                <option value="3x1m">3x1 meter (3 m²)</option>
                <option value="4x1m">4x1 meter (4 m²)</option>
                <option value="5x1m">5x1 meter (5 m²)</option>
                <option value="6x1m">6x1 meter (6 m²)</option>
                <option value="custom">Custom Size</option>
            </select>
        </div>
        
        <div class="calculator-row" id="customSizeRow" style="display: none;">
            <label class="calculator-label">📐 Ukuran Custom</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; width: 100%;">
                <div>
                    <label style="font-size: 0.8rem; color: #64748b;">Panjang (meter)</label>
                    <input type="number" class="form-input" id="panjang" step="0.1" min="0.1" value="2.0" placeholder="Panjang">
                </div>
                <div>
                    <label style="font-size: 0.8rem; color: #64748b;">Lebar (meter)</label>
                    <input type="number" class="form-input" id="lebar" step="0.1" min="0.1" value="1.0" placeholder="Lebar">
                </div>
            </div>
            <div id="luasInfo" style="margin-top: 5px; font-size: 0.8rem; color: #64748b; text-align: center;">
                Total Luas: <span id="totalLuas">2.0</span> m²
            </div>
        </div>
        
        <div class="calculator-row">
            <label class="calculator-label">🎨 Material</label>
            <select class="form-select" id="material">
                <option value="vinyl">Vinyl Standard</option>
                <option value="banner_cloth">Banner Cloth</option>
                <option value="flexi_korea">Flexi Korea</option>
                <option value="albatros">Albatros</option>
            </select>
        </div>
        
        <div class="calculator-row">
            <label class="calculator-label">✨ Finishing</label>
            <select class="form-select" id="finishing">
                <option value="none">Tanpa Finishing</option>
                <option value="mata_ayam">Mata Ayam</option>
                <option value="tali_tambang">Tali Tambang</option>
                <option value="jahit_tepi">Jahit Tepi</option>
            </select>
        </div>
        
        <div class="calculator-row">
            <label class="calculator-label">🎨 Include Design</label>
            <select class="form-select" id="includeDesign">
                <option value="yes">Ya, dengan desain (+Rp 25.000)</option>
                <option value="no">Tidak, saya punya file siap cetak</option>
            </select>
        </div>
        
        <div class="calculator-info">
            <div style="background: #f1f5f9; padding: 12px; border-radius: 8px; margin-top: 10px;">
                <small style="color: #64748b;">
                    <strong>💡 Info:</strong> Masukkan panjang dan lebar dalam meter. 
                    Contoh: Panjang 2.5 m x Lebar 1.2 m = 3.0 m²
                </small>
            </div>
        </div>
        
        <!-- Hidden fields for form submission -->
        <input type="hidden" id="hiddenQuantity" name="quantity" value="1">
        <input type="hidden" id="hiddenSize" name="size" value="2x1m">
        <input type="hidden" id="hiddenMaterial" name="material" value="vinyl">
        <input type="hidden" id="hiddenFinishing" name="finishing" value="none">
        <input type="hidden" id="hiddenIncludeDesign" name="includeDesign" value="yes">
        <input type="hidden" id="hiddenPanjang" name="panjang" value="2.0">
        <input type="hidden" id="hiddenLebar" name="lebar" value="1.0">
    `;

  // Add event listener for custom size toggle
  const sizeSelect = document.getElementById("size");
  const customRow = document.getElementById("customSizeRow");

  sizeSelect.addEventListener("change", function () {
    if (this.value === "custom") {
      customRow.style.display = "flex";
    } else {
      customRow.style.display = "none";
    }
    calculateCalculatorPrice();
  });

  // Add event listeners for panjang and lebar inputs
  const panjangInput = document.getElementById("panjang");
  const lebarInput = document.getElementById("lebar");

  if (panjangInput && lebarInput) {
    panjangInput.addEventListener("input", updateLuasInfo);
    lebarInput.addEventListener("input", updateLuasInfo);
    panjangInput.addEventListener("input", calculateCalculatorPrice);
    lebarInput.addEventListener("input", calculateCalculatorPrice);
  }

  // Update luas info function
  function updateLuasInfo() {
    const panjang = parseFloat(panjangInput.value) || 0;
    const lebar = parseFloat(lebarInput.value) || 0;
    const luas = (panjang * lebar).toFixed(2);

    const luasInfo = document.getElementById("totalLuas");
    if (luasInfo) {
      luasInfo.textContent = luas;
    }
  }

  // Add event listeners for other inputs
  const inputs = ["quantity", "material", "finishing", "includeDesign"];
  inputs.forEach((id) => {
    const input = document.getElementById(id);
    if (input) {
      input.addEventListener("input", calculateCalculatorPrice);
      input.addEventListener("change", calculateCalculatorPrice);
    }
  });

  // Trigger change on initial load
  setTimeout(() => {
    sizeSelect.dispatchEvent(new Event("change"));
    updateLuasInfo();
  }, 100);
}

function setupBannerFlexiOptions(container) {
  container.innerHTML = `
        <div class="calculator-row">
            <label class="calculator-label">📊 Jumlah</label>
            <input type="number" class="form-input" id="quantity" value="1" min="1" max="1000">
            <span style="margin-top: 5px; font-size: 0.9rem; margin-left: 10px;">pcs</span>
        </div>
        
        <div class="calculator-row">
            <label class="calculator-label">📏 Ukuran</label>
            <select class="form-select" id="size">
                <option value="2x1m">2x1 meter (2 m²)</option>
                <option value="3x1m">3x1 meter (3 m²)</option>
                <option value="4x1m">4x1 meter (4 m²)</option>
                <option value="5x1m">5x1 meter (5 m²)</option>
                <option value="6x1m">6x1 meter (6 m²)</option>
                <option value="custom">Custom Size</option>
            </select>
        </div>
        
        <div class="calculator-row" id="customSizeRow" style="display: none;">
            <label class="calculator-label">📐 Ukuran Custom</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; width: 100%;">
                <div>
                    <label style="font-size: 0.8rem; color: #64748b;">Panjang (meter)</label>
                    <input type="number" class="form-input" id="panjang" step="0.1" min="0.1" value="2.0" placeholder="Panjang">
                </div>
                <div>
                    <label style="font-size: 0.8rem; color: #64748b;">Lebar (meter)</label>
                    <input type="number" class="form-input" id="lebar" step="0.1" min="0.1" value="1.0" placeholder="Lebar">
                </div>
            </div>
            <div id="luasInfo" style="margin-top: 5px; font-size: 0.8rem; color: #64748b; text-align: center;">
                Total Luas: <span id="totalLuas">2.0</span> m²
            </div>
        </div>
        
        <div class="calculator-row">
            <label class="calculator-label">🎨 Material</label>
            <select class="form-select" id="material">
                <option value="flexi_korea">Flexi Korea</option>
                <option value="flexi_china">Flexi China</option>
                <option value="flexi_premium">Flexi Premium</option>
            </select>
        </div>
        
        <div class="calculator-row">
            <label class="calculator-label">✨ Finishing</label>
            <select class="form-select" id="finishing">
                <option value="none">Tanpa Finishing</option>
                <option value="mata_ayam">Mata Ayam</option>
                <option value="tali_tambang">Tali Tambang</option>
                <option value="jahit_tepi">Jahit Tepi</option>
                <option value="ring_besi">Ring Besi</option>
            </select>
        </div>
        
        <div class="calculator-row">
            <label class="calculator-label">🎨 Include Design</label>
            <select class="form-select" id="includeDesign">
                <option value="yes">Ya, dengan desain (+Rp 30.000)</option>
                <option value="no">Tidak, saya punya file siap cetak</option>
            </select>
        </div>
        
        <div class="calculator-info">
            <div style="background: #f1f5f9; padding: 12px; border-radius: 8px; margin-top: 10px;">
                <small style="color: #64748b;">
                    <strong>💡 Info:</strong> Banner Flexi lebih tahan lama dan elastis. 
                    Cocok untuk penggunaan outdoor yang membutuhkan ketahanan lebih.
                </small>
            </div>
        </div>
        
        <!-- Hidden fields for form submission -->
        <input type="hidden" id="hiddenQuantity" name="quantity" value="1">
        <input type="hidden" id="hiddenSize" name="size" value="2x1m">
        <input type="hidden" id="hiddenMaterial" name="material" value="flexi_korea">
        <input type="hidden" id="hiddenFinishing" name="finishing" value="none">
        <input type="hidden" id="hiddenIncludeDesign" name="includeDesign" value="yes">
        <input type="hidden" id="hiddenPanjang" name="panjang" value="2.0">
        <input type="hidden" id="hiddenLebar" name="lebar" value="1.0">
    `;

  // Add event listener for custom size toggle
  const sizeSelect = document.getElementById("size");
  const customRow = document.getElementById("customSizeRow");

  sizeSelect.addEventListener("change", function () {
    if (this.value === "custom") {
      customRow.style.display = "flex";
    } else {
      customRow.style.display = "none";
    }
    calculateCalculatorPrice();
  });

  // Add event listeners for panjang and lebar inputs
  const panjangInput = document.getElementById("panjang");
  const lebarInput = document.getElementById("lebar");

  if (panjangInput && lebarInput) {
    panjangInput.addEventListener("input", updateLuasInfo);
    lebarInput.addEventListener("input", updateLuasInfo);
    panjangInput.addEventListener("input", calculateCalculatorPrice);
    lebarInput.addEventListener("input", calculateCalculatorPrice);
  }

  // Update luas info function
  function updateLuasInfo() {
    const panjang = parseFloat(panjangInput.value) || 0;
    const lebar = parseFloat(lebarInput.value) || 0;
    const luas = (panjang * lebar).toFixed(2);

    const luasInfo = document.getElementById("totalLuas");
    if (luasInfo) {
      luasInfo.textContent = luas;
    }
  }

  // Add event listeners for other inputs
  const inputs = ["quantity", "material", "finishing", "includeDesign"];
  inputs.forEach((id) => {
    const input = document.getElementById(id);
    if (input) {
      input.addEventListener("input", calculateCalculatorPrice);
      input.addEventListener("change", calculateCalculatorPrice);
    }
  });

  // Trigger change on initial load
  setTimeout(() => {
    sizeSelect.dispatchEvent(new Event("change"));
    updateLuasInfo();
  }, 100);
}

// ... (setupBrosurOptions, setupStickerOptions, setupKartuNamaOptions,
// setupAksesorisOptions tetap sama)

function attachCalculatorEventListeners() {
  const calculatorInputs = [
    "quantity",
    "sides",
    "size",
    "paper",
    "lamination",
    "folding",
    "material",
    "finishing",
    "accessory_type",
    "printing_type",
    "customSize",
    "includeDesign",
    "panjang",
    "lebar", // Tambahkan panjang dan lebar
  ];

  calculatorInputs.forEach((inputId) => {
    const input = document.getElementById(inputId);
    if (input) {
      input.addEventListener("input", calculateCalculatorPrice);
      input.addEventListener("change", calculateCalculatorPrice);
    }
  });
}

// ... (initializeTabs, initializeLoadingOverlay, initializeGallery tetap sama)

// Initialize event listeners
function initializeEventListeners() {
  // Product checkout form
  const productCheckoutForm = document.getElementById("productCheckoutForm");
  if (productCheckoutForm) {
    productCheckoutForm.addEventListener("submit", function (e) {
      e.preventDefault();
      handleProductCheckout();
    });
  }

  // Calculator checkout form
  const calculatorCheckoutForm = document.getElementById("calculatorCheckoutForm");
  if (calculatorCheckoutForm) {
    calculatorCheckoutForm.addEventListener("submit", function (e) {
      e.preventDefault();
      handleCalculatorCheckout();
    });
  }

  // Product quantity change
  const productQuantityInput = document.querySelector('input[name="quantity"]');
  if (productQuantityInput) {
    productQuantityInput.addEventListener("input", calculateProductTotal);
  }

  // Modal buttons
  document.querySelectorAll(".modal-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
      const modal = this.closest(".modal-overlay");
      if (modal) {
        modal.style.display = "none";
      }
    });
  });

  // Show/hide scroll to top button
  window.addEventListener("scroll", function () {
    const scrollToTopBtn = document.getElementById("scrollToTop");
    if (scrollToTopBtn) {
      if (window.pageYOffset > 300) {
        scrollToTopBtn.classList.add("visible");
      } else {
        scrollToTopBtn.classList.remove("visible");
      }
    }
  });

  // Add click event to scroll to top button
  const scrollToTopBtn = document.getElementById("scrollToTop");
  if (scrollToTopBtn) {
    scrollToTopBtn.addEventListener("click", scrollToTop);
  }

  // Smooth scrolling for navigation links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    });
  });
}

// ... (calculateProductTotal tetap sama)

// Calculate calculator price - UPDATED for category support
function calculateCalculatorPrice() {
  const categorySlug = CONFIG.categorySlug || CONFIG.category;
  let total = 0;

  switch (categorySlug) {
    case "banner":
      total = calculateBannerPrice();
      break;
    case "bannerflexi":
    case "banner_flexi":
      total = calculateBannerFlexiPrice();
      break;
    case "brosur":
      total = calculateBrosurPrice();
      break;
    case "sticker":
      total = calculateStickerPrice();
      break;
    case "kartu_nama":
      total = calculateKartuNamaPrice();
      break;
    case "aksesoris":
      total = calculateAksesorisPrice();
      break;
    default:
      total = calculateBrosurPrice(); // Default
  }

  // Update display only
  const calculatorTotalElement = document.getElementById("calculatorTotalPrice");
  if (calculatorTotalElement) {
    calculatorTotalElement.textContent = "Rp " + Math.round(total).toLocaleString("id-ID");
  }

  // Update hidden fields
  updateHiddenFields();
}

function calculateBannerPrice() {
  const quantity = parseInt(document.getElementById("quantity")?.value) || 1;
  const size = document.getElementById("size")?.value || "2x1m";
  const material = document.getElementById("material")?.value || "vinyl";
  const finishing = document.getElementById("finishing")?.value || "none";
  const includeDesign = document.getElementById("includeDesign")?.value || "yes";
  const panjang = parseFloat(document.getElementById("panjang")?.value) || 2.0;
  const lebar = parseFloat(document.getElementById("lebar")?.value) || 1.0;

  // Base prices (in Rupiah)
  const basePrices = {
    "2x1m": 25000,
    "3x1m": 35000,
    "4x1m": 45000,
    "5x1m": 55000,
    "6x1m": 65000,
    custom: 10000, // per square meter
  };

  const materials = {
    vinyl: 1.0,
    banner_cloth: 1.2,
    flexi_korea: 1.5,
    albatros: 1.8,
  };

  const finishings = {
    none: 1.0,
    mata_ayam: 1.1,
    tali_tambang: 1.15,
    jahit_tepi: 1.2,
  };

  let basePrice = basePrices[size] || basePrices["2x1m"];

  if (size === "custom") {
    const luas = panjang * lebar;
    basePrice = basePrices.custom * luas;
  }

  let total = basePrice * quantity * (materials[material] || 1.0) * (finishings[finishing] || 1.0);

  if (includeDesign === "yes") {
    total += 25000;
  }

  return total;
}

function calculateBannerFlexiPrice() {
  const quantity = parseInt(document.getElementById("quantity")?.value) || 1;
  const size = document.getElementById("size")?.value || "2x1m";
  const material = document.getElementById("material")?.value || "flexi_korea";
  const finishing = document.getElementById("finishing")?.value || "none";
  const includeDesign = document.getElementById("includeDesign")?.value || "yes";
  const panjang = parseFloat(document.getElementById("panjang")?.value) || 2.0;
  const lebar = parseFloat(document.getElementById("lebar")?.value) || 1.0;

  // Base prices (in Rupiah)
  const basePrices = {
    "2x1m": 30000,
    "3x1m": 40000,
    "4x1m": 50000,
    "5x1m": 60000,
    "6x1m": 70000,
    custom: 15000, // per square meter
  };

  const materials = {
    flexi_korea: 1.5,
    flexi_china: 1.2,
    flexi_premium: 2.0,
  };

  const finishings = {
    none: 1.0,
    mata_ayam: 1.1,
    tali_tambang: 1.15,
    jahit_tepi: 1.2,
    ring_besi: 1.3,
  };

  let basePrice = basePrices[size] || basePrices["2x1m"];

  if (size === "custom") {
    const luas = panjang * lebar;
    basePrice = basePrices.custom * luas;
  }

  let total = basePrice * quantity * (materials[material] || 1.5) * (finishings[finishing] || 1.0);

  if (includeDesign === "yes") {
    total += 30000; // Design fee lebih tinggi untuk flexi
  }

  return total;
}

// ... (calculateBrosurPrice, calculateStickerPrice, calculateKartuNamaPrice,
// calculateAksesorisPrice tetap sama)

function updateHiddenFields() {
  const categorySlug = CONFIG.categorySlug || CONFIG.category;

  // Update common hidden fields
  const quantity = document.getElementById("quantity")?.value || 1;
  const hiddenQuantity = document.getElementById("hiddenQuantity");
  if (hiddenQuantity) hiddenQuantity.value = quantity;

  // Update category-specific hidden fields
  switch (categorySlug) {
    case "banner":
    case "bannerflexi":
    case "banner_flexi":
      const size = document.getElementById("size")?.value || "2x1m";
      const material = document.getElementById("material")?.value || "vinyl";
      const finishing = document.getElementById("finishing")?.value || "none";
      const includeDesign = document.getElementById("includeDesign")?.value || "yes";
      const panjang = document.getElementById("panjang")?.value || "2.0";
      const lebar = document.getElementById("lebar")?.value || "1.0";

      setHiddenValue("hiddenSize", size);
      setHiddenValue("hiddenMaterial", material);
      setHiddenValue("hiddenFinishing", finishing);
      setHiddenValue("hiddenIncludeDesign", includeDesign);
      setHiddenValue("hiddenPanjang", panjang);
      setHiddenValue("hiddenLebar", lebar);
      break;

    // ... (cases lainnya tetap sama)
  }
}

function setHiddenValue(id, value) {
  const element = document.getElementById(id);
  if (element) element.value = value;
}

// ... (handleProductCheckout, handleCalculatorCheckout,
// formatWhatsAppMessage, showModal, hideModal, scrollToTop tetap sama)
