<div class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
    <div class="form-group mb-0">
        <div class="input-group input-group-alternative input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input class="form-control" id="search-bar" placeholder="Search" type="text" value="{{ $keyword ?? '' }}">
        </div>
    </div>
</div>

<script>
    const searchBar = document.getElementById("search-bar");
    searchBar.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            searchBar.disabled = true
            let keyword = searchBar.value;
            window.location.href = `/search?keyword=${keyword}`
        }
    });
</script>
