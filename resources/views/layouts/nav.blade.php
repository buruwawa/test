
    <div id="accordion" style="background-color:#18684e; !important">
        <ul class="nav flex-column">
            @role('Sales')
            <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}">
                <a href="{{ route('admin.index') }}" class="nav-link">
                    <span class="svg-icon nav-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </span>
                    <span class="btn-sm">
                        Dashboard
                    </span>
                </a>
            </li>

            <li class="nav-item  {{ (request()->is('sales')) ? 'active' : '' }}">
                <a href="/sales" class="nav-link">
                    <span class="svg-icon nav-icon">
                        <i class="fas fa-clipboard-check font-size-h4" ></i>
                    </span>
                    <span class="nav-text">
                        Sales
                    </span>
                </a>
            </li>
            <li class="nav-item  {{ (request()->is('outstandings')) ? 'active' : '' }}">
                <a href="/outstandings" class="nav-link">
                    <span class="svg-icon nav-icon">
                        <i class="fas fa-arrow-right font-size-h4" ></i>
                    </span>
                    <span class="nav-text">
                        Outstanding
                    </span>
                </a>
            </li>

            <li class="nav-item {{ (request()->is('my-stock')) ? 'active' : '' }}">
                <a href="/my-stock" class="nav-link">
                    <span class="svg-icon nav-icon">
                        <i class="fas fa-money-bill font-size-h4"></i>
                    </span>
                    <span class="nav-text">
                        Stocks
                    </span>
                </a>
            </li>
            @endrole

            @role('Admin|Account')
            <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}">
                <a href="/admin" class="nav-link">
                    <span class="svg-icon nav-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </span>
                    <span class="nav-text">
                        Dashboard
                    </span>
                </a>
            </li>
            @endrole



 <!--   <li class="nav-item
        {{ (request()->is('stock-purchase')) ? 'active' : '' }}
        ">
        <a href="/stock-purchase" class="nav-link sub-nav-link {{ (request()->is('stock-purchase')) ? 'active' : '' }}">
            <span class="svg-icon nav-icon">
                <i class="fas fa-list font-size-h4"></i>
            </span>
            <span class="nav-text">Purchases</span>
        </a>
        </li>
 -->
     <div><hr></div>   
        @role('Admin|Store|Account')
          <li class="nav-item {{ (request()->is('Checklist')) ? 'active' : '' }} {{ (request()->is('Checklist')) ? 'active' : '' }}">
            <a  class="nav-link" data-toggle="collapse" href="#rental" role="button"
            aria-expanded="false" aria-controls="rental">
                <span class="svg-icon nav-icon">
                    <i class="fas fa-check font-size-h4"></i>
                </span>
                <span class="btn-sm">Checklist</span>
                <i class="fas fa-chevron-right fa-rotate-90"></i>
            </a> 
            <div class="collapse nav-collapse {{ (request()->is('Checklist')) ? 'show' : '' }}
                {{ (request()->is('Checklist')) ? 'show' : '' }}
                " id="rental" data-parent="#accordion">
                <ul class="nav flex-column">

                    <li class="nav-item {{ (request()->is('Checklist')) ? 'sub-active' : '' }}">
                        <a href="/checklist/{id}" class="nav-link sub-nav-link {{ (request()->is('Checklist')) ? 'active' : '' }}">
                            <span class="svg-icon nav-icon d-flex justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                  </svg>
                            </span>
                            <span class="nav-text">Checklist</span>
                        </a>
                    </li>

                  <!--   <li class="nav-item {{ (request()->is('rent-items')) ? 'sub-active' : '' }}">
                        <a href="/rent-items" class="nav-link sub-nav-link {{ (request()->is('rent-items')) ? 'active' : '' }}">
                            <span class="svg-icon nav-icon d-flex justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                  </svg>
                            </span>
                            <span class="nav-text">Renting Item </span>
                        </a>
                    </li> -->
                </ul>
            </div>
        </li>

   <!--      <li class="nav-item {{ (request()->is('sales')) ? 'active' : '' }} {{ (request()->is('outstandings')) ? 'active' : '' }}">
            <a  class="nav-link" data-toggle="collapse" href="#sales" role="button"
            aria-expanded="false" aria-controls="sales">
                <span class="svg-icon nav-icon">
                    <i class="fas fa-money-bill font-size-h4"></i>
                </span>
                <span class="nav-text">Sales</span>
                <i class="fas fa-chevron-right fa-rotate-90"></i>
            </a>
            <div class="collapse nav-collapse {{ (request()->is('sales')) ? 'show' : '' }}
                {{ (request()->is('outstandings')) ? 'show' : '' }}
                " id="sales" data-parent="#accordion">
                <ul class="nav flex-column">

                    <li class="nav-item {{ (request()->is('sales')) ? 'sub-active' : '' }}">
                        <a href="/sales" class="nav-link sub-nav-link {{ (request()->is('sales')) ? 'active' : '' }}">
                            <span class="svg-icon nav-icon d-flex justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                  </svg>
                            </span>
                            <span class="nav-text">Sales List</span>
                        </a>
                    </li>

                    <li class="nav-item {{ (request()->is('outstandings')) ? 'sub-active' : '' }}">
                        <a href="/outstandings" class="nav-link sub-nav-link {{ (request()->is('outstandings')) ? 'active' : '' }}">
                            <span class="svg-icon nav-icon d-flex justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                  </svg>
                            </span>
                            <span class="nav-text">Outstandings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endrole -->
         <!--    @role('Admin|Store')
            <li class="nav-item {{ (request()->is('stocking')) ? 'active' : '' }} {{ (request()->is('stores')) ? 'active' : '' }}">
                <a  class="nav-link" data-toggle="collapse" href="#stock" role="button"
                aria-expanded="false" aria-controls="stock">
                    <span class="svg-icon nav-icon">
                        <i class="fas fa-money-bill font-size-h4"></i>
                    </span>
                    <span class="nav-text">Stock</span>
                    <i class="fas fa-chevron-right fa-rotate-90"></i>
                </a>
                <div class="collapse nav-collapse {{ (request()->is('stocking')) ? 'show' : '' }}
                    {{ (request()->is('stores')) ? 'show' : '' }}
                    " id="stock" data-parent="#accordion">
                    <ul class="nav flex-column">

                        <li class="nav-item {{ (request()->is('stocking')) ? 'sub-active' : '' }}">
                            <a href="/stocking" class="nav-link sub-nav-link {{ (request()->is('stocking')) ? 'active' : '' }}">
                                <span class="svg-icon nav-icon d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                      </svg>
                                </span>
                                <span class="nav-text">Issue Stock</span>
                            </a>
                        </li>

                        <li class="nav-item {{ (request()->is('stocking')) ? 'sub-active' : '' }}">
                            <a href="/issued-stock" class="nav-link sub-nav-link {{ (request()->is('pending-stock')) ? 'active' : '' }}">
                                <span class="svg-icon nav-icon d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                      </svg>
                                </span>
                                <span class="nav-text">Issued Stocks</span>
                            </a>
                        </li>

                            <li class="nav-item {{ (request()->is('stocking')) ? 'sub-active' : '' }}">
                            <a href="/returned-stock" class="nav-link sub-nav-link {{ (request()->is('pending-stock')) ? 'active' : '' }}">
                                <span class="svg-icon nav-icon d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                      </svg>
                                </span>
                                <span class="nav-text">Returned Stocks</span>
                            </a>
                        </li>

                        <li class="nav-item {{ (request()->is('stores')) ? 'sub-active' : '' }}">
                            <a href="/stores" class="nav-link sub-nav-link {{ (request()->is('stores')) ? 'active' : '' }}">
                                <span class="svg-icon nav-icon d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                      </svg>
                                </span>
                                <span class="nav-text">Stores</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
@endrole
 -->

            @role('Admin|Account')
            <li class="nav-item
            {{ (request()->is('payment')) ? 'active' : '' }}
            {{ (request()->is('account/1')) ? 'active' : '' }}
            {{ (request()->is('account')) ? 'active' : '' }}
            {{ (request()->is('expenses')) ? 'active' : '' }}
            ">
                <a  class="nav-link" data-toggle="collapse" href="#payment" role="button"
                aria-expanded="false" aria-controls="stock">
                    <span class="svg-icon nav-icon">
                        <i class="fas fa-file-invoice-dollar font-size-h4"></i>
                    </span>
                    <span class="btn-sm">Finance</span>
                    <i class="fas fa-chevron-right fa-rotate-90"></i>
                </a>
                <div class="collapse nav-collapse
                    {{ (request()->is('payment')) ? 'show' : '' }}
                    {{ (request()->is('account')) ? 'show' : '' }}
                    {{ (request()->is('account/1')) ? 'show' : '' }}
                    {{ (request()->is('expenses')) ? 'show' : '' }}
                    " id="payment" data-parent="#accordion">
                    <ul class="nav flex-column">

                        <li class="nav-item {{ (request()->is('account')) ? 'sub-active' : '' }}">
                            <a href="/account" class="nav-link sub-nav-link {{ (request()->is('account')) ? 'active' : '' }}">
                                <span class="svg-icon nav-icon d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                      </svg>
                                </span>
                                <span class="nav-text">Cash Account</span>
                            </a>
                        </li>
                        <li class="nav-item {{ (request()->is('expenses')) ? 'sub-active' : '' }}">
                            <a href="/expenses" class="nav-link sub-nav-link {{ (request()->is('expenses')) ? 'active' : '' }}">
                                <span class="svg-icon nav-icon d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                      </svg>
                                </span>
                                <span class="nav-text">Expenses</span>
                            </a>
                        </li>

                        <li class="nav-item {{ (request()->is('payment')) ? 'sub-active' : '' }}">
                            <a href="/payment" class="nav-link sub-nav-link {{ (request()->is('payment')) ? 'active' : '' }}">
                                <span class="svg-icon nav-icon d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                      </svg>
                                </span>
                                <span class="nav-text">Supplier Invoices</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            @endrole
            <!--  @role('Admin')
            <li class="nav-item
            {{ (request()->is('customers-list')) ? 'active' : '' }}
            {{ (request()->is('suppliers')) ? 'active' : '' }}
            {{ (request()->is('customershow/')) ? 'active' : '' }}">
                <a  class="nav-link" data-toggle="collapse" href="#people" role="button"
                aria-expanded="false" aria-controls="sales">
                    <span class="svg-icon nav-icon">
                        <span class="fa fa-users"></span>
                    </span>
                    <span class="nav-text">People</span>
                    <i class="fas fa-chevron-right fa-rotate-90"></i>
                </a>
                <div class="collapse nav-collapse
                {{ (request()->is('customers-list')) ? 'show' : '' }}
                {{ (request()->is('customershow/')) ? 'show' : '' }}
                {{ (request()->is('suppliers')) ? 'show' : '' }}
                    " id="people" data-parent="#accordion">
                    <ul class="nav flex-column">

                        <li class="nav-item {{ (request()->is('customers-list')) ? 'sub-active' : '' }}">
                            <a href="/customers-list" class="nav-link sub-nav-link {{ (request()->is('customers-list')) ? 'active' : '' }}">
                                <span class="svg-icon nav-icon d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                      </svg>
                                </span>
                                <span class="nav-text">Customers</span>
                            </a>
                        </li>

                        <li class="nav-item {{ (request()->is('suppliers')) ? 'sub-active' : '' }}">
                            <a href="/suppliers" class="nav-link sub-nav-link {{ (request()->is('suppliers')) ? 'active' : '' }}">
                                <span class="svg-icon nav-icon d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                      </svg>
                                </span>
                                <span class="nav-text">Suppliers</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
 -->

<li class="nav-item
{{ (request()->is('report-sales')) ? 'active' : '' }}
{{ (request()->is('report-purchase')) ? 'active' : '' }}
{{ (request()->is('report-item')) ? 'active' : '' }}
{{ (request()->is('filter-sales')) ? 'active' : '' }}
{{ (request()->is('ffilter-item')) ? 'active' : '' }}
{{ (request()->is('stock-reports')) ? 'active' : '' }}
{{ (request()->is('stock-filter')) ? 'active' : '' }}
{{ (request()->is('expenses-filter')) ? 'active' : '' }}
{{ (request()->is('expenses-report')) ? 'active' : '' }}
{{ (request()->is('finance')) ? 'active' : '' }}
{{ (request()->is('transaction-report')) ? 'active' : '' }}
{{ (request()->is('transaction-filter')) ? 'active' : '' }}
{{ (request()->is('purchases')) ? 'active' : '' }}
">
    <a  class="nav-link" data-toggle="collapse" href="#Report" role="button"
    aria-expanded="false" aria-controls="Report">
        <span class="svg-icon nav-icon">
            <i class="fas fa-chart-line font-size-h4" ></i>
        </span>
        <span class="btn-sm">Reports</span>
        <i class="fas fa-chevron-right fa-rotate-90"></i>
    </a>
    <div class="collapse nav-collapse
    {{ (request()->is('report-sales')) ? 'show' : '' }}
    {{ (request()->is('report-purchase')) ? 'show' : '' }}
    {{ (request()->is('report-item')) ? 'show' : '' }}
    {{ (request()->is('filter-sales')) ? 'show' : '' }}
    {{ (request()->is('filter-item')) ? 'show' : '' }}
    {{ (request()->is('stock-reports')) ? 'show' : '' }}
    {{ (request()->is('expenses-filter')) ? 'show' : '' }}
    {{ (request()->is('expenses-report')) ? 'show' : '' }}
    {{ (request()->is('finance')) ? 'show' : '' }}
    {{ (request()->is('transaction-report')) ? 'show' : '' }}
    {{ (request()->is('transaction-filter')) ? 'show' : '' }}
    {{ (request()->is('stock-alert')) ? 'show' : '' }}
    {{ (request()->is('purchases')) ? 'show' : '' }}
    " id="Report"  data-parent="#accordion">
        <ul class="nav flex-column">

            <li class="nav-item {{ (request()->is('report-sales')) ? 'sub-active' : '' }}{{ (request()->is('filter-sales')) ? 'sub-active' : '' }}">
                <a href="{{ route('report-sales') }}" class="nav-link sub-nav-link {{ (request()->is('report-sales')) ? 'active' : '' }} {{ (request()->is('filter-sales')) ? 'active' : '' }} ">
                    <span class="svg-icon nav-icon d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          </svg>
                    </span>
                    <span class="nav-text">Sales Report</span>
                </a>
            </li>
             <li class="nav-item
                {{ (request()->is('report-purchase')) ? 'sub-active' : '' }}
                {{ (request()->is('purchases')) ? 'sub-active' : '' }}">
                <a href="{{ route('report-purchase') }}" class="nav-link sub-nav-link
                {{ (request()->is('report-purchase')) ? 'active' : '' }}
                {{ (request()->is('purchases')) ? 'active' : '' }} ">
                    <span class="svg-icon nav-icon d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          </svg>
                    </span>
                    <span class="nav-text">Purchase Report</span>
                </a>
            </li>

         
            <li class="nav-item {{ (request()->is('expenses-report')) ? 'sub-active' : '' }}{{ (request()->is('expenses-filter')) ? 'sub-active' : '' }}">
                <a href="/expenses-report" class="nav-link sub-nav-link {{ (request()->is('expenses-report')) ? 'active' : '' }} {{ (request()->is('expenses-filter')) ? 'active' : '' }}  ">
                    <span class="svg-icon nav-icon d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          </svg>
                    </span>
                    <span class="nav-text">Expenses Report</span>
                </a>
            </li>

            <li class="nav-item {{ (request()->is('stock-reports')) ? 'sub-active' : '' }}{{ (request()->is('stock-filter')) ? 'sub-active' : '' }}">
                <a href="/stock-reports" class="nav-link sub-nav-link {{ (request()->is('stock-reports')) ? 'active' : '' }} {{ (request()->is('stock-filter')) ? 'active' : '' }}  ">
                    <span class="svg-icon nav-icon d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          </svg>
                    </span>
                    <span class="nav-text">Stock Report</span>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('stock-alert')) ? 'sub-active' : '' }}{{ (request()->is('stock-filter')) ? 'sub-active' : '' }}">
                <a href="/stock-alert" class="nav-link sub-nav-link {{ (request()->is('stock-alert')) ? 'active' : '' }}">
                    <span class="svg-icon nav-icon d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          </svg>
                    </span>
                    <span class="nav-text">Stock Alert</span>
                </a>
            </li>

            <li class="nav-item
            {{ (request()->is('transaction-report')) ? 'sub-active' : '' }}
            {{ (request()->is('transaction-filter')) ? 'sub-active' : '' }}
                ">
                <a href="/transaction-report" class="nav-link sub-nav-link
                {{ (request()->is('transaction-report')) ? 'active' : '' }}
                {{ (request()->is('transaction-filter')) ? 'active' : '' }}
                ">
                    <span class="svg-icon nav-icon d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          </svg>
                    </span>
                    <span class="nav-text">Transactions Report</span>
                </a>
            </li>
             <li class="nav-item {{ (request()->is('finance')) ? 'sub-active' : '' }}">
                <a href="/finance" class="nav-link sub-nav-link {{ (request()->is('finance')) ? 'active' : '' }}">
                    <span class="svg-icon nav-icon d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          </svg>
                    </span>
                    <span class="nav-text">Finance Report</span>
                </a>
            </li>

        </ul>
    </div>
</li>

<div><hr></div>
            <li class="nav-item
            {{ (request()->is('assign-indicator')) ? 'active' : '' }}
            {{ (request()->is('indicator')) ? 'active' : '' }}
            ">
                <a class="nav-link" data-toggle="collapse" href="#Indicatorsettings" role="button"
                aria-expanded="false" aria-controls="Indicatorsettings">
                    <span class="svg-icon nav-icon">
                        <i class="fas fa-cogs font-size-h4"></i>
                    </span>
                    <span class="btn-sm">Indicator Settings</span>
                    <i class="fas fa-chevron-right fa-rotate-90"></i>
                 </a>

                <div class="collapse nav-collapse
                {{ (request()->is('assign-indicator')) ? 'show' : '' }}
                {{ (request()->is('indicator')) ? 'show' : '' }}
                " id="Indicatorsettings" data-parent="#accordion">
                    <div id="accordion">
                        <ul class="nav flex-column">

                              <li class="nav-item {{ (request()->is('assign-indicator')) ? 'sub-active' : '' }}">
                                <a href="/assign-indicator/{id}" class="nav-link sub-nav-link {{ (request()->is('assign-indicator')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text" data-toggle="tooltip" data-placement="bottom" title="Assign Indicators to Metaname">AIM</span>
                                </a>
                         </li> 
                                                   
                              <li class="nav-item {{ (request()->is('indicator')) ? 'sub-active' : '' }}">
                                <a href="/indicator/{id}" class="nav-link sub-nav-link {{ (request()->is('indicator')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Reg. Indicator</span>
                                </a>
                            </li>                         

                        </ul>
                    </div>
                </div>
            </li>


     <li class="nav-item
            {{ (request()->is('property')) ? 'active' : '' }}
            {{ (request()->is('metadata')) ? 'active' : '' }}
            {{ (request()->is('metaname')) ? 'active' : '' }}
            ">
                <a  class="nav-link" data-toggle="collapse" href="#settingp" role="button"
                aria-expanded="false" aria-controls="settingp">
                    <span class="svg-icon nav-icon">
                        <i class="fas fal fa-server"></i>
                    </span>
                    <span class="btn-sm">Metadata Settings</span>
                    <i class="fas fa-chevron-right fa-rotate-90"></i>
                </a>

                <div class="collapse nav-collapse
                {{ (request()->is('property')) ? 'show' : '' }}
                {{ (request()->is('metadata')) ? 'show' : '' }}
                {{ (request()->is('metaname')) ? 'show' : '' }}
                " id="settingp" data-parent="#accordion">
                    <div id="accordion3">
                        <ul class="nav flex-column">
              
    <li class="nav-item {{ (request()->is('property')) ? 'sub-active' : '' }}">
                                <a href="/property/{id}" class="nav-link sub-nav-link {{ (request()->is('property')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Register Property</span>
                                </a>
                            </li>   

         <li class="nav-item {{ (request()->is('metadata')) ? 'sub-active' : '' }}">
                                <a href="/metadata" class="nav-link sub-nav-link {{ (request()->is('metadata')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Metadatas</span>
                                </a>
                            </li>   

                               <li class="nav-item {{ (request()->is('metaname')) ? 'sub-active' : '' }}">
                                <a href="/metaname" class="nav-link sub-nav-link {{ (request()->is('metaname')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Metanames</span>
                                </a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </li>


     <li class="nav-item
            {{ (request()->is('property')) ? 'active' : '' }}
            {{ (request()->is('assign-roles')) ? 'active' : '' }}
           {{ (request()->is('assign-roles-user')) ? 'active' : '' }}
            {{ (request()->is('activity-roles')) ? 'active' : '' }}
            ">
                <a  class="nav-link" data-toggle="collapse" href="#settingr" role="button"
                aria-expanded="false" aria-controls="settingr">
                    <span class="svg-icon nav-icon">
                        <i class="fas far fa-user-tag"></i>
                    </span>
                    <span class="btn-sm">Roles & Permission</span>
                    <i class="fas fa-chevron-right fa-rotate-90"></i>
                </a>

                <div class="collapse nav-collapse
                {{ (request()->is('property')) ? 'show' : '' }}
                {{ (request()->is('assign-roles')) ? 'show' : '' }}
                {{ (request()->is('assign-roles-user')) ? 'show' : '' }}
                {{ (request()->is('activity-roles')) ? 'show' : '' }}
                " id="settingr" data-parent="#accordion">
                    <div id="accordion3">
                        <ul class="nav flex-column">
              
     <li class="nav-item {{ (request()->is('activity-roles')) ? 'sub-active' : '' }}">
                                <a href="/activity-roles/{id}" class="nav-link sub-nav-link {{ (request()->is('activity-roles')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text" data-toggle="tooltip" data-placement="bottom" title="Attach activities to roles">AARos</span>
                                </a>
    </li> 


  <li class="nav-item {{ (request()->is('assign-roles')) ? 'sub-active' : '' }}">
                                <a href="/assign-roles/{id}" class="nav-link sub-nav-link {{ (request()->is('assign-roles')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                     <span class="nav-text" data-toggle="tooltip" data-placement="bottom" title="Assign roles to department">ARODE</span>
                                </a>
    </li>

     <li class="nav-item {{ (request()->is('assign-roles-user')) ? 'sub-active' : '' }}">
                                <a href="/assign-roles-user/{id}" class="nav-link sub-nav-link {{ (request()->is('assign-roles-user')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                     <span class="nav-text" data-toggle="tooltip" data-placement="bottom" title="Assign roles to User">AROU</span>
                                </a>
    </li>

     <li class="nav-item {{ (request()->is('user-activity')) ? 'sub-active' : '' }}">
                                <a href="/user-activity/{id}" class="nav-link sub-nav-link {{ (request()->is('user-activity')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text" data-toggle="tooltip" data-placement="bottom" title="Assign Activities to User">AAU</span>
                                </a>
    </li> 



                        </ul>
                    </div>
                </div>
            </li>


            <li class="nav-item
            {{ (request()->is('warehouse')) ? 'active' : '' }}
            {{ (request()->is('shops')) ? 'active' : '' }}
            {{ (request()->is('profile')) ? 'active' : '' }}
            {{ (request()->is('user-register')) ? 'active' : '' }}
            {{ (request()->is('users')) ? 'active' : '' }}
              {{ (request()->is('assign-roles')) ? 'active' : '' }}
            ">
                <a  class="nav-link" data-toggle="collapse" href="#setting" role="button"
                aria-expanded="false" aria-controls="setting">
                    <span class="svg-icon nav-icon">
                        <i class="fas fa-cogs font-size-h4"></i>
                    </span>
                    <span class="btn-sm">General Settings</span>
                    <i class="fas fa-chevron-right fa-rotate-90"></i>
                </a>

                <div class="collapse nav-collapse
                {{ (request()->is('warehouse')) ? 'show' : '' }}
                {{ (request()->is('shops')) ? 'show' : '' }}
                {{ (request()->is('profile')) ? 'show' : '' }}
                {{ (request()->is('user-register')) ? 'show' : '' }}
                {{ (request()->is('users')) ? 'show' : '' }}
                 {{ (request()->is('assign-roles')) ? 'active' : '' }}
                " id="setting" data-parent="#accordion">
                    <div id="accordion3">
                        <ul class="nav flex-column">
                            <li class="nav-item {{ (request()->is('profile')) ? 'sub-active' : '' }}">
                                <a href="/profile" class="nav-link sub-nav-link {{ (request()->is('profile')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Profile</span>
                                </a>
                            </li>

                                                      


                            <li class="nav-item {{ (request()->is('stocks')) ? 'sub-active' : '' }}">
                                <a href="/sites" class="nav-link sub-nav-link {{ (request()->is('sites')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Sites</span>
                                </a>
                            </li>
                           
                              <li class="nav-item {{ (request()->is('stocks')) ? 'sub-active' : '' }}">
                                <a href="/department" class="nav-link sub-nav-link {{ (request()->is('department')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Departments</span>
                                </a>
                            </li>                         

                               <li class="nav-item {{ (request()->is('role-register')) ? 'sub-active' : '' }}">
                                <a href="{{ route('role-register.index') }}" class="nav-link sub-nav-link {{ (request()->is('role-register')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Add role</span>
                                </a>
                            </li>

                              <li class="nav-item {{ (request()->is('user-register')) ? 'sub-active' : '' }}">
                                <a href="{{ route('user-register.index') }}" class="nav-link sub-nav-link {{ (request()->is('user-register')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Add user</span>
                                </a>
                            </li>


                            <li class="nav-item {{ (request()->is('users')) ? 'sub-active' : '' }}">
                                <a href="/users" class="nav-link sub-nav-link {{ (request()->is('users')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Users</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </li>
<div><hr></div>
           
            <li class="nav-item
            {{ (request()->is('recovery-department')) ? 'active' : '' }}
            {{ (request()->is('recovery-site')) ? 'active' : '' }}
            {{ (request()->is('recovery-metadata')) ? 'active' : '' }}
            {{ (request()->is('recovery-metaname')) ? 'active' : '' }}
          
            ">
                <a  class="nav-link" data-toggle="collapse" href="#datarec" role="button"
                aria-expanded="false" aria-controls="datarec">
                    <span class="svg-icon nav-icon">
                        <i class="fas fa-solid fa-database"></i>
                    </span>
                    <span class="btn-sm">Data Recovery</span>
                    <i class="fas fa-chevron-right fa-rotate-90"></i>
                </a>

                <div class="collapse nav-collapse
                {{ (request()->is('recovery-department')) ? 'show' : '' }}
                {{ (request()->is('recovery-site')) ? 'show' : '' }}
                {{ (request()->is('recovery-metadata')) ? 'show' : '' }}
                {{ (request()->is('recovery-metaname')) ? 'show' : '' }}
                            " id="datarec" data-parent="#accordion">
                    <div id="accordion3">
                        <ul class="nav flex-column">
                                                             
                              <li class="nav-item {{ (request()->is('recovery-department')) ? 'sub-active' : '' }}">
                                <a href="/recovery-department" class="nav-link sub-nav-link {{ (request()->is('recovery-department')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Department Recovery</span>
                                </a>
                            </li>

                            <li class="nav-item {{ (request()->is('recovery-site')) ? 'sub-active' : '' }}">
                                <a href="/recovery-site" class="nav-link sub-nav-link {{ (request()->is('recovery-site')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Site Data Recovery</span>
                                </a>
                            </li>


                            <li class="nav-item {{ (request()->is('recovery-metadata')) ? 'sub-active' : '' }}">
                                <a href="/recovery-metadata" class="nav-link sub-nav-link {{ (request()->is('recovery-metadata')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Metadata Recovery</span>
                                </a>
                            </li>


                            <li class="nav-item {{ (request()->is('recovery-metaname')) ? 'sub-active' : '' }}">
                                <a href="/recovery-metaname" class="nav-link sub-nav-link {{ (request()->is('recovery-metaname')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Metaname Recovery</span>
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('recovery-role')) ? 'sub-active' : '' }}">
                                <a href="/recovery-role" class="nav-link sub-nav-link {{ (request()->is('recovery-role')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">Role Recovery</span>
                                </a>
                            </li>

                             <li class="nav-item {{ (request()->is('recovery-user')) ? 'sub-active' : '' }}">
                                <a href="/recovery-user" class="nav-link sub-nav-link {{ (request()->is('recovery-user')) ? 'active' : '' }}">
                                    <span class="svg-icon nav-icon d-flex justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          </svg>
                                    </span>
                                    <span class="nav-text">User Recovery</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li> 
            @endrole
            <!-- <div style="margin: 100px 10px 10px 10px"> -->
                <div class="text-center text-primary"><hr>
                    <strong>Checklist Master</strong>
                    <!-- <img style="height: 20px;" alt="Logo" src="../../assets/images/misc/moran.png" /></div> -->
              <!-- </div> -->
        </ul>

    </div>


