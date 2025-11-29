// js/app.js
import { db } from "../firebase-config.js";
import { collection, getDocs, query, orderBy } from "https://www.gstatic.com/firebasejs/11.10.0/firebase-firestore.js";

const grid = document.getElementById('products-grid');

async function loadProducts() {
  try {
    const q = query(collection(db, 'products'), orderBy('name'));
    const snap = await getDocs(q);
    // nếu bạn muốn thay thế 3 card dịch vụ bằng products, xóa innerHTML ban đầu
    // grid.innerHTML = '';
    // but ở đây mình sẽ append sản phẩm nổi bật phía dưới thẻ dịch vụ nếu muốn
    // Dưới đây là ví dụ append product cards sau thẻ dịch vụ
    snap.forEach(doc => {
      const p = doc.data();
      const card = document.createElement('article');
      card.className = 'card';
      card.innerHTML = `
        <img src="${p.image || 'images/service1.jpg'}" alt="${escapeHtml(p.name)}" />
        <div class="card-body">
          <h3>${escapeHtml(p.name)}</h3>
          <p>${escapeHtml(p.description || '')}</p>
          <div style="margin-top:10px;font-weight:600;color:var(--green-700);">${formatCurrency(p.price)}</div>
        </div>
      `;
      grid.appendChild(card);
    });
  } catch (err) {
    console.error('Lỗi load products', err);
  }
}

function formatCurrency(n){
  if (typeof n !== 'number') return '';
  return n.toLocaleString('vi-VN') + ' ₫';
}

function escapeHtml(s){
  if(!s) return '';
  return s.replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;');
}

loadProducts();
