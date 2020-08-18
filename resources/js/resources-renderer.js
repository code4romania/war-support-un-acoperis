class ResourcesRenderer {
    constructor(ajaxUrl, deleteText, detailsText, typeTranslations) {
        this.ajaxUrl = ajaxUrl;
        this.deleteText = deleteText;
        this.detailsText = detailsText;
        this.typeTranslations = typeTranslations;
    }

    renderHelpRequests(pageState) {
        axios.get(this.ajaxUrl, {params: pageState})
    .then(res => {
            this.updateResultsCount(res.data.total);
            this.renderTable(res.data.data);
            this.renderPagination(res.data);
        });
    }

    emptyTable() {
        $('#tableBody tr').remove();
    }

    updateResultsCount(count) {
        $('#totalResults').text(count);

        if (0 === count) {
            $('.no-results').removeClass('d-none').addClass('d-flex');
            $('.details').addClass('d-none');
        } else {
            $('.no-results').removeClass('d-flex').addClass('d-none');
            $('.details').removeClass('d-none');
        }
    }

    renderTable(responseData) {
        this.emptyTable();
        const _this = this
        $.each(responseData, function(key, value) {
            let row = '<tr id="clinic-container-' + value.id + '">\n' +
                '    <td><a href="/admin/resources/' + value.id + '">' + value.full_name + '</a></td>\n' +
                '    <td>' + _this.typeTranslations[value.type] + '</td>\n' +
                '    <td>' + value.country + '</td>\n' +
                '    <td>' + value.city + '</td>\n' +
                '    <td>' + moment(value.created_at).locale('ro').format('LLL') + '</td>\n' +
                '    <td class="text-right">\n' +
                '        <a href="#" class="btn btn-sm btn-danger mb-2 mb-sm-0 delete-resource" data-id=' + value.id + '>' + _this.deleteText + '</a>\n' +
                '        <a href="/admin/resources/' + value.id + '" class="btn btn-sm btn-info mb-2 mb-sm-0">' + _this.detailsText + '</a>\n' +
                '    </td>\n' +
                '</tr>';

            $('#tableBody').append(row);
        });
    }

    renderPagination(response) {
        $('.pagination li').remove();

        if (1 === response.last_page) {
            return;
        }

        let morePages = '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';

        let currentPage = '<li class="page-item active"><a class="page-link" data-page="' + response.current_page + '" href="#">' + response.current_page + ' <span class="sr-only">(current)</span></a></li>';

        let firstPage = '';
        if (response.current_page > 1) {
            firstPage = '<li class="page-item"><a class="page-link" data-page="1" href="#">1</a></li>';
        }

        let step = response.current_page
        let counter = 0;

        let previousPages = '';
        while(step > 2 && 2 > counter) {
            counter++;
            step--;
            previousPages = '<li class="page-item"><a class="page-link" data-page="' + step + '" href="#">' + step + '</a></li>' + previousPages;
        }

        if (response.current_page > 4) {
            previousPages = morePages + previousPages;
        }

        step = response.current_page;
        counter = 0;

        let nextPages = '';
        while(step < response.last_page - 1 && 2 > counter) {
            counter++;
            step++;
            nextPages += '<li class="page-item"><a class="page-link" data-page="' + step + '" href="#">' + step + '</a></li>';
        }

        if ((response.last_page - response.current_page) > 3) {
            nextPages += morePages;
        }

        let lastPage = '';
        if (response.current_page < response.last_page) {
            lastPage = '<li class="page-item"><a class="page-link" data-page="' + response.last_page + '" href="#">' + response.last_page + '</a></li>';
        }

        $('.pagination').append(firstPage).append(previousPages).append(currentPage).append(nextPages).append(lastPage);
    }
}
