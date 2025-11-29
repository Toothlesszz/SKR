import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js";
import { getFirestore, collection, getDocs } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-firestore.js";

const firebaseConfig = {
  apiKey: "AIzaSyA_hQQQXDWZU7wh0AyK9ZqiMXWSqkZgeZM",
  authDomain: "greenbike-web.firebaseapp.com",
  projectId: "greenbike-web",
  storageBucket: "greenbike-web.firebasestorage.app",
  messagingSenderId: "338757518645",
  appId: "1:338757518645:web:06180450a02ade7829f87c",
  measurementId: "G-YXW03WHDY7"
};

const app = initializeApp(firebaseConfig);
const db = getFirestore(app);

export async function loadProducts() {
  try {
    const querySnapshot = await getDocs(collection(db, "products"));
    let products = [];
    querySnapshot.forEach((doc) => {
      products.push({ id: doc.id, ...doc.data() });
    });
    console.log("📦 Products loaded:", products);
    return products;
  } catch (err) {
    console.error("🔥 Lỗi khi lấy dữ liệu Firestore:", err);
    return [];
  }
}
