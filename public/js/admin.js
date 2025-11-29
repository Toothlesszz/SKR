// js/admin.js
import { db, auth } from "../firebase-config.js";
import {
  collection, addDoc, getDocs, deleteDoc, doc, updateDoc, query, where
} from "https://www.gstatic.com/firebasejs/11.10.0/firebase-firestore.js";
import {
  signInWithEmailAndPassword, signOut, onAuthStateChanged
} from "https://www.gstatic.com/firebasejs/11.10.0/firebase-auth.js";

const btnShowLogin = document.getElementById('btn-show-login');
const loginPanel = document.getElementById('login-panel');
const btnLogin = document.getElementById('btn-login');
const btnLogout = document.getElementById('btn-logout');
const authArea = document.getElementById('auth-area');

const form = document.getElementById('productForm');
const productList = document.getElementById('productList');

btnShowLogin.addEventListener('click', () => {
  loginPanel.style.display = loginPanel.style.display === 'none' ? 'block' : 'none';
});

btnLogin.addEventListener('click', async () => {
  const email = document.getElementById('login-email').value;
  const pass = document.getElementById('login-pass').value;
  try {
    await signInWithEmailAndPassword(auth, email, pass);
  } catch(e) {
    alert('Đăng nhập thất bại: ' + e.message);
  }
});

btnLogout.addEventListener('click', async () => {
  await signOut(auth);
});

onAuthStateChanged(auth, (user) => {
  if (user) {
    btnShowLogin.style.display = 'none';
    btnLogout.style.display = 'inline-block';
    loginPanel.style.display = 'none';
    loadProducts();
  } else {
    btnShowLogin.style.display = 'inline-block';
    btnLogout.style.display = 'none';
    productList.innerHTML = '<p>Vui lòng đăng nhập để quản lý sản phẩm.</p>';
  }
});

async function loadProducts() {
  productList.innerHTML = '';
  const snap = await getDocs(collection(db, 'products'));
  snap.forEach(docSnap => {
    const p = docSnap.data();
    const el = document.createElement('div');
    el.className = 'product-card';
    el.innerHTML = `
      <img src="${p.image || 'images/service1.jpg'}" style="width:100%;height:140px;object-fit:cover;border-radius:8px" />
      <h4 style="margin:8px 0">${escapeHtml(p.name)}</h4>
      <div style="color:var(--green-700);font-weight:700">${formatCurrency(p.price)}</div>
      <div style="margin-top:8px;display:flex;gap:8px;justify-content:center">
        <button data-id="${docSnap.id}" class="btn outline btn-edit">Sửa</button>
        <button data-id="${docSnap.id}" class="btn" style="background:#ef4444;color:#fff">Xóa</button>
      </div>
    `;
    // xóa
    el.querySelector('button[style]').addEventListener('click', async (e) => {
      if (confirm('Xóa sản phẩm này?')) {
        await deleteDoc(doc(db, 'products', e.target.dataset.id));
        loadProducts();
      }
    });
    // sửa
    el.querySelector('.btn-edit').addEventListener('click', () => {
      fillFormForEdit(docSnap.id, p);
    });
    productList.appendChild(el);
  });
}

let editId = null;
function fillFormForEdit(id, p) {
  editId = id;
  document.getElementById('name').value = p.name || '';
  document.getElementById('price').value = p.price || '';
  document.getElementById('image').value = p.image || '';
  document.getElementById('description').value = p.description || '';
  document.getElementById('category').value = p.category || '';
}

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  const newP = {
    name: document.getElementById('name').value,
    price: parseFloat(document.getElementById('price').value) || 0,
    image: document.getElementById('image').value,
    description: document.getElementById('description').value,
    category: document.getElementById('category').value
  };
  if (editId) {
    // update
    await updateDoc(doc(db, 'products', editId), newP);
    editId = null;
  } else {
    await addDoc(collection(db, 'products'), newP);
  }
  form.reset();
  loadProducts();
});

function formatCurrency(n){ if(typeof n !== 'number') return ''; return n.toLocaleString('vi-VN') + ' ₫'; }
function escapeHtml(s){ if(!s) return ''; return s.replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;'); }
