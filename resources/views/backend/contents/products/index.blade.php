@extends('backend.template')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Products</div>
            </div>
            <div class="page-title-actions">
                <button type="button" data-toggle="tooltip" title="Delete" data-placement="bottom" class="btn-shadow mr-3 btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
                </button>
                <div class="d-inline-block dropdown">
                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-business-time fa-w-20"></i>
                    </span>
                    Buttons
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="nav-link-icon lnr-inbox"></i>
                                    <span>
                                        Inbox
                                    </span>
                                    <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="nav-link-icon lnr-book"></i>
                                    <span>
                                        Book
                                    </span>
                                    <div class="ml-auto badge badge-pill badge-danger">5</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="nav-link-icon lnr-picture"></i>
                                    <span>
                                        Picture
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a disabled href="javascript:void(0);" class="nav-link disabled">
                                    <i class="nav-link-icon lnr-file-empty"></i>
                                    <span>
                                        File Disabled
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title"><i class="metismenu-icon pe-7s-menu"></i> Product List</h5>
                    <table class="mb-0 table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="10"><input type="checkbox"></th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th class="text-center" width="80">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                               <td><input type="checkbox"></td>
                               <td>Image</td>
                               <td>Sweater</td>
                               <td>100</td>
                               <td>100</td>
                               <td class="text-center">
                                   <a href="" class="btn btn-primary btn-sm" title="Edit"><i class="pe-7s-note font-weight-bold"></i></a>
                               </td>
                           </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title"><i class="metismenu-icon pe-7s-search"></i> Filter</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection