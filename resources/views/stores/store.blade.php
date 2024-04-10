@extends('stores.layouts.app')
@section('content')
<section class="section-two container">
    <div class="row-sec">
      <div class="col-sec">
        <div class="history-table">
          <div class="table-head">
            <p>Create Stores</p>
          </div>
          <table>
            <thead>
              <tr>
                <th>Store ID</th>
                <th>Store Name</th>
                <th>Store Type</th>
                <th>Store Email</th>
                <th>Profit Percentage</th>
                <th>Issue Date</th>
                <th>Valid Till</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>001</td>
                <td>SN_1</td>
                <td>Store Type_1</td>
                <td>store@email.com</td>
                <td>1.00%</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
              <tr>
                <td>001</td>
                <td>SN_1</td>
                <td>Store Type_1</td>
                <td>store@email.com</td>
                <td>1.00%</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
              <tr>
                <td>001</td>
                <td>SN_1</td>
                <td>Store Type_1</td>
                <td>store@email.com</td>
                <td>1.00%</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
              <tr>
                <td>001</td>
                <td>SN_1</td>
                <td>Store Type_1</td>
                <td>store@email.com</td>
                <td>1.00%</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
              <tr>
                <td>001</td>
                <td>SN_1</td>
                <td>Store Type_1</td>
                <td>store@email.com</td>
                <td>1.00%</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
              <tr>
                <td>001</td>
                <td>SN_1</td>
                <td>Store Type_1</td>
                <td>store@email.com</td>
                <td>1.00%</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
              <tr>
                <td>001</td>
                <td>SN_1</td>
                <td>Store Type_1</td>
                <td>store@email.com</td>
                <td>1.00%</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
            </tbody>
          </table>
          <div class="table-footer">
            <a href="#" id="addStores">Add Stores</a>
          </div>
        </div>
        <div class="storesForm" id="storesForm">
          <div class="content">
            <!-- <span class="closeBtn" id="closeBtn">&times;</span> -->
            <p>Form</p>
            <div class="stores-form-grid">
              <form action="">
                <div class="form--div">
                  <div class="form--details form--details--left">
                     <div class="inner-form-details">
                      <label for="store-id">Store ID *</label>
                      <input type="number" id="store-id" placeholder="Enter id"></input>
                     </div>
                     <div class="inner-form-details">
                      <label for="store-name">Store Name *</label>
                      <input type="name" id="store-name" placeholder="Enter name"></input>
                     </div>
                     <div class="inner-form-details">
                      <label for="store-type">Store Type *</label>
                      <input type="name" id="store-type" placeholder="Enter Store Type"></input>
                     </div>
                     <div class="inner-form-details">
                      <label for="store-email">Store Email *</label>
                      <img src="./images/alphanumeric@.svg" width="20" alt="">
                      <input type="email" id="store-email" placeholder="Professional@email.com"></input>
                     </div>
                     <div class="inner-form-details">
                      <img src="./images/eye.svg" width="20" alt="">
                      <label for="password">Create Password *</label>
                      <input type="password" id="password" placeholder="********"></input>
                     </div>
                     <div class="inner-form-details">
                      <img src="./images/eye.svg" width="20" alt="">
                      <label for="confirm-password">Confirm Password *</label>
                      <input type="password" id="confirm-password" placeholder="********"></input>
                     </div>
                     <div class="inner-form-details">
                      <img src="./images/phone.svg" alt="">
                      <label for="store-contact">Store Contact *</label>
                      <input type="number" id="store-contact" placeholder="+92-854785784"></input>
                     </div>
                  </div>
                  <div class="form--details form--details--right">
                    <div class="inner-form-details">
                      <label for="store-payment">Store Payment Method *</label>
                      <input type="text" id="store-payment" placeholder="Bank Name"></input>
                     </div>
                     <div class="inner-form-details">
                      <label for="bank-iban">Store Payment Method *</label>
                      <input type="text" id="bank-iban" placeholder="Bank IBAN"></input>
                     </div>
                     <div class="inner-form-details">
                      <label for="percentage">Profit Percentage *</label>
                      <input type="text" id="percentage" placeholder="Type Percentage"></input>
                     </div>
                     <div class="inner-form-details">
                      <label for="date">Issue Date *</label>
                      <input type="date" id="date" name="myDate">
                     </div>
                     <div class="inner-form-details">
                      <label for="valid">Valid Till *</label>
                      <input type="date" id="valid" placeholder="Select date">
                     </div>
                     <div class="form-btns">
                      <input type="reset" id="closeBtn" class="closeBtn" value="Cancel">
                      <input type="submit" value="Submit">
                     </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-two container" id="section-two">
    <div class="row-sec">
      <div>
        <div class="history-table">
          <div class="table-head">
            <p>Create Cashier</p>
          </div>
          <table>
            <thead>
              <tr>
                <th>Cashier id</th>
                <th>Cashier Name</th>
                <th>Store Name</th>
                <th>Cashier Contact</th>
                <th>Store Id</th>
                <th>Issue Date</th>
                <th>Valid Till</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>001</td>
                <td>C1_Name</td>
                <td>Store name 1</td>
                <td>+92-345785485</td>
                <td>ST_001</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
              <tr>
                <td>001</td>
                <td>C1_Name</td>
                <td>Store name 1</td>
                <td>+92-345785485</td>
                <td>ST_001</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
              <tr>
                <td>001</td>
                <td>C1_Name</td>
                <td>Store name 1</td>
                <td>+92-345785485</td>
                <td>ST_001</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
              <tr>
                <td>001</td>
                <td>C1_Name</td>
                <td>Store name 1</td>
                <td>+92-345785485</td>
                <td>ST_001</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
              <tr>
                <td>001</td>
                <td>C1_Name</td>
                <td>Store name 1</td>
                <td>+92-345785485</td>
                <td>ST_001</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
              <tr>
                <td>001</td>
                <td>C1_Name</td>
                <td>Store name 1</td>
                <td>+92-345785485</td>
                <td>ST_001</td>
                <td>5/11/2023</td>
                <td>5/11/2023</td>
              </tr>
            </tbody>
          </table>
          <div class="table-footer">
            <a href="#" id="addCashier">Add Cashier</a>
          </div>
          <div class="cashierForm" id="cashierForm">
            <div id="content">
              <!-- <span class="closeBtn" id="closeBtn">&times;</span> -->
              <p>Form</p>
              <div class="stores-form-grid">
                <form action="">
                  <div class="cashier--form--div" id="cashier--form--div">
                    <div class="form--details form--details--left">
                       <div class="inner-form-details">
                        <label for="cashier-id">Cashier ID *</label>
                        <input type="number" id="cashier-id" placeholder="Enter id"></input>
                       </div>
                       <div class="inner-form-details">
                        <label for="Cashier-name">Cashier Name *</label>
                        <input type="name" id="Cashier-name" placeholder="Enter name"></input>
                       </div>
                       <div class="inner-form-details">
                        <label for="username">Store Type *</label>
                        <input type="name" id="username" placeholder="Enter name"></input>
                       </div>
                       <div class="inner-form-details">
                        <!-- <img src="./images/down-arrow.png" alt=""> -->
                        <label for="select-store">Select Store *</label>
                        <select name="" id="select-store">
                          <option value="">Option 1</option>
                          <option value="">Option 2</option>
                          <option value="">Option 3</option>
                        </select>
                       </div>
                       <div class="inner-form-details">
                        <img src="./images/eye.svg" width="20" alt="">
                        <label for="password">Create Password *</label>
                        <input type="password" id="password" placeholder="********"></input>
                       </div>
                       <div class="inner-form-details">
                        <img src="./images/eye.svg" width="20" alt="">
                        <label for="confirm-password">Confirm Password *</label>
                        <input type="password" id="confirm-password" placeholder="********"></input>
                       </div>
                       <div class="inner-form-details">
                        <img src="./images/phone.svg" alt="">
                        <label for="Cashier-contact">Cashier Contact *</label>
                        <input type="number" id="Cashier-contact" placeholder="+92-854785784"></input>
                       </div>
                       <div id="form-btns">
                        <input type="reset" id="cashierCloseBtn" class="closeBtn" value="Cancel">
                        <input type="submit" value="Submit">
                       </div>
                    </div>
                    <div class="form--details form--details--right">
                      <div class="form--details--right--img">
                        <img src="./images/6248754 1.png" alt="">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
