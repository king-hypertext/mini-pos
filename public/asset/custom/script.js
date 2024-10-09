(() => {
    console.log('App is running!');
    const currentUrl = window.location.href;
    const stripURL = currentUrl.replace(/(#.*|[\?].*)/g, '');
    const nav_menu_link = document.querySelectorAll('.nav-menu > a.nav-menu-link');
    [...nav_menu_link].forEach(link => {
        link.parentElement.classList.remove('active');
        if (link.href == stripURL) {
            link.parentElement.classList.add('active');
        }
    });
    document.getElementById('refresh').onclick = () => self.location.reload(true);
    self.addEventListener('keyup', (event) => {
        event.key === '/' ? document.getElementById('search-input').focus() : event.preventDefault();
    });
    self.addEventListener('DOMContentLoaded', () => document.querySelector('.preloader').style.display = 'none');
    $.each($('input[type="tel"]'), function (index, value) {
        $(value).keypress(function (e) {
            if (isNaN(String.fromCharCode(e.which))) {
                e.preventDefault();
            }
        });
    });
})();

class Product {
    constructor(id, name, price, quantity, image = null, taxRate = 0) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.quantity = quantity;
        this.taxRate = taxRate;
        this.image = image;
    }

    tax() {
        return this.price * this.quantity * (this.taxRate / 100);
    }

    subTotal() {
        return this.price * this.quantity;
    }
}

class Cart {
    constructor() {
        this.products = [];
        this.loadFromLocalStorage();
    }

    addProduct(product) {
        const $thisProduct = this.products.find(p => p.id === product.id);
        if (!$thisProduct) {
            this.products.push(product);
            this.saveToLocalStorage();
            window.location.reload();
            return true;
        } else {
            alert($thisProduct.name.toString().toUpperCase() + " already added to the Cart");
        }
        return false;
    }
    updateProductQuantity(id, quantity) {
        const product_id = this.products.findIndex(product => product.id === id);
        if (product_id !== -1) {
            this.products[product_id].quantity = quantity;
            this.saveToLocalStorage();
            // window.location.reload();
        }
    }
    incrementProductQuantity(product_id) {
        this.updateProductQuantity(product_id, this.getProductQuantity(product_id) + 1)
    }
    decrementProductQuantity(product_id) {
        const quantity = this.getProductQuantity(product_id);
        if (quantity > 1) {
            this.updateProductQuantity(product_id, quantity - 1);
        } else {
            this.removeProduct(product_id)
        }
    }
    getProductQuantity(product_id) {
        const product = this.products.find(product => product.id === product_id);
        return product ? product.quantity : 0;
    }
    removeProduct(productId) {
        if (!productId || !Array.isArray(this.products)) return;

        this.products = this.products.filter(product => product.id !== productId);
        this.saveToLocalStorage();
    }


    subTotal() {
        return 'GHS ' + this.products.reduce((acc, product) => acc + product.subTotal(), 0).toFixed(2);
    }

    tax() {
        return this.products.reduce((acc, product) => acc + product.tax(), 0);
    }

    discount(discountPercentage = 0) {
        return this.subTotal() * discountPercentage / 100;
    }

    totalAmount(excludeTax = false, discountPercentage = 0) {
        const subtotal = this.subTotal();
        const tax = excludeTax ? 0 : this.tax();
        const discount = this.discount(discountPercentage);
        return subtotal + tax - discount;
    }

    printCart() {
        // return this.products;
        console.log("Cart:");
        this.products.forEach(product => {
            // return product;
            console.log(`- ${product.name} x ${product.quantity} = $${product.subTotal().toFixed(2)}`);
        });
        console.log(`Subtotal: $${this.subTotal()}`);
        console.log(`Tax: $${this.tax().toFixed(2)}`);
        console.log(`Discount: $${this.discount().toFixed(2)}`);
        console.log(`Total: $${this.totalAmount().toFixed(2)}`);
    }
    getCartData() {
        return this.products;
    }
    isCartNotEmpty() {
        return this.products.length > 0 && true;
    }
    saveToLocalStorage() {
        localStorage.setItem("cart", JSON.stringify(this.products));
    }

    loadFromLocalStorage() {
        const storedCart = localStorage.getItem("cart");
        if (storedCart) {
            const products = JSON.parse(storedCart);
            this.products = products.map((product) => new Product(
                product.id,
                product.name,
                product.price,
                product.quantity,
                product.image,
                product.taxRate
            ));
        }
    }


    clear() {
        this.products = [];
        localStorage.removeItem("cart");
        window.location.reload();
    }
}
const cart = new Cart();
const tableBody = document.getElementById('cart-row');
const addToCartButton = document.querySelectorAll('.add-to-cart-button');
[...addToCartButton].forEach(btn => {
    btn.addEventListener('click', (event) => {
        const max_qty = parseInt(event.currentTarget.dataset.qty);
        const product_id = event.currentTarget.dataset.product;
        const row = event.currentTarget.closest('tr');
        const cells = row.cells;
        const data = {
            id: product_id,
            image: cells[1].querySelector('img').src,
            name: cells[2].textContent.trim(),
            brand: cells[3].textContent.trim(),
            category: cells[4].textContent.trim(),
            price: cells[5].textContent.trim(),
            quantity: 1,
            expiryDate: cells[7].textContent.trim(),
            max_qty: max_qty
        };

        const isProductAddedToCart = cart.addProduct(new Product(data.id, data.name, data.price, 1, data.image));

        if (isProductAddedToCart) {
            document.querySelector('.cart-subtotal, .cart-payable').textContent = cart.subTotal();
            document.querySelector('.cart-payable').textContent = cart.subTotal();
            const newRow = createCartRow(data);
            tableBody.appendChild(newRow);
        }
    });
});

console.log(cart.getCartData(), cart.isCartNotEmpty());
function reloadCart() {
    if (cart.isCartNotEmpty()) {
        try {
            cart.getCartData().forEach(data => {
                const newRow = createCartRow(data);
                tableBody.appendChild(newRow);
            });
        } catch (error) {
            console.error('Error populating cart table:', error);
        }
    }
}
function createCartRow({ id, name, price, quantity, max_qty }) {
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
      <td scope="row">${name}</td>
      <td>
        <div class="d-flex">
          <button class="btn btn-link px-2 decrement-btn" data-id="${id}">
            <i class="fas fa-minus"></i>
          </button>
          <input readonly id="quantity-${id}" min="1" max="${max_qty}" name="quantity" value="${quantity}" type="number" class="form-control form-control-sm" style="max-width: 60px; padding-right: 0;" />
          <button class="btn btn-link px-2 increment-btn" data-id="${id}">
            <i class="fas fa-plus"></i>
          </button>
        </div>
      </td>
      <td>${price}</td>
    `;
    return newRow;
}

self.addEventListener('DOMContentLoaded', function () {
    reloadCart();
    this.document.querySelector('button.clear-cart').addEventListener('click', () => {
        if (this.confirm('Confirm to clear Cart? \nPress OK to continue')) {
            cart.clear();
        }
        this.window.location.reload();
    });
    this.document.querySelector('.cart-subtotal, .cart-payable').textContent = cart.subTotal();
    this.document.querySelector('.cart-payable').textContent = cart.subTotal();
    const incrementButtons = document.querySelectorAll('.increment-btn');
    const decrementButtons = document.querySelectorAll('.decrement-btn');

    incrementButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const productId = e.currentTarget.dataset.id;
            cart.incrementProductQuantity(productId);
            cart.updateProductQuantity(productId, cart.getProductQuantity(productId));
            this.document.querySelector('.cart-subtotal, .cart-payable').textContent = cart.subTotal();
            this.document.querySelector('.cart-payable').textContent = cart.subTotal();
            e.currentTarget.parentNode.querySelector('input[type=number]').stepUp();
        });
    });

    decrementButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const productId = e.currentTarget.dataset.id;
            cart.decrementProductQuantity(productId);
            cart.updateProductQuantity(productId, cart.getProductQuantity(productId));
            this.document.querySelector('.cart-subtotal, .cart-payable').textContent = cart.subTotal();
            this.document.querySelector('.cart-payable').textContent = cart.subTotal();
            e.currentTarget.parentNode.querySelector('input[type=number]').stepDown();
        });
    });

});

function printCart() {
    const cartData = cart.getCartData();
    const date = new Date().toLocaleDateString();
    const subtotal = cart.subTotal();
    const total = cart.subTotal();

    const styles = `
      .receipt-container {
        width: 80%;
        margin: 40px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        // box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      header {
        text-align: center;
      }
      table {
        width: 100%;
        border-collapse: collapse;
      }
      th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
      }
      th {
        background-color: #f0f0f0;
      }
      tfoot {
        font-weight: bold;
      }
      footer {
        text-align: center;
        margin-top: 20px;
      }
    `;

    const receiptHtml = `
      <div class="receipt-container">
        <header>
          <h1>Receipt</h1>
          <p>Company Name</p>
          <p>Date: ${date}</p>
        </header>
        <table>
          <thead>
            <tr>
              <th>Item</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            ${cartData.map(item => `
              <tr>
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>${item.price}</td>
                <td>${(item.price * item.quantity).toFixed(2)}</td>
              </tr>
            `).join('')}
          </tbody>
          <tfoot>
            <tr>
              <th colspan="3">Subtotal:</th>
              <th>${subtotal}</th>
            </tr>
            <tr>
              <th colspan="3">Total:</th>
              <th>${total}</th>
            </tr>
          </tfoot>
        </table>
        <footer>
          <p>Thank you for your purchase!</p>
        </footer>
      </div>
    `;

    const printWindow = window.open('');
    printWindow.document.head.innerHTML = `<style>${styles}</style>`;
    printWindow.document.body.innerHTML = receiptHtml;
    printWindow.print();
    printWindow.close();
}
document.querySelector('button.confirm-btn').addEventListener('click', function () {
    printCart();
});