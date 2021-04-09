<!DOCTYPE html>
<html lang="en">
    <head>
        @include('templates/header_includes')
    </head>
    <body class="no-skin">
        <div class="main-container" id="main-container">
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="page-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="error-container">
                                    <div class="well">
                                        <h1 class="grey lighter smaller">
                                            <span class="blue bigger-125">
                                                <i class="ace-icon fa fa-sitemap"></i>
                                                404
                                            </span>
                                            Page Not Found
                                        </h1>
                                        <hr />
                                        <h3 class="lighter smaller">We looked everywhere but we couldn't find it!</h3>
                                        <div>
                                            <form class="form-search">
                                                <span class="input-icon align-middle">
                                                    <i class="ace-icon fa fa-search"></i>
                                                    <input type="text" class="search-query" placeholder="Give it a search..." />
                                                </span>
                                                <button class="btn btn-sm" type="button">Go!</button>
                                            </form>
                                            <div class="space"></div>
                                            <h4 class="smaller">Try one of the following:</h4>
                                            <ul class="list-unstyled spaced inline bigger-110 margin-15">
                                                <li>
                                                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                                                    Re-check the url for typos
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                                                    Read the faq
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                                                    Tell us about it
                                                </li>
                                            </ul>
                                        </div>
                                        <hr />
                                        <div class="space"></div>
                                        <div class="center">
                                            <a href="javascript:history.back()" class="btn btn-grey">
                                                <i class="ace-icon fa fa-arrow-left"></i>
                                                Go Back
                                            </a>
                                            <a href="#" class="btn btn-primary">
                                                <i class="ace-icon glyphicon glyphicon-star"></i>
                                                Dashboard
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('templates/footer')
            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div>
        @include('templates/footer_includes')
    </body>
</html>
