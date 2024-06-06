@include('partials.modal-show')
<table id="mr-table" class="table table-dark table-hover shadow mb-2 mt-3">
    <thead>
        <tr>
            <th scope="col">#id {{ ucfirst($elementName) }}</th>
            <th scope="col">{{ ucfirst($elementName) }} Title</th>
            <th scope="col" class="d-none d-xl-table-cell">Created at</th>
            <th scope="col" class="d-none d-lg-table-cell">Type</th>
            <th scope="col" class="{{ Route::currentRouteName() === 'admin.' . $elementName . 's.index' ? '' : 'd-none' }}">
                Administration Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($elements as $element)
            <tr>
                <td>{{ $element->id }}</td>
                <td>{{ $element->title ?? $element->name }}</td>
                <td class="d-none d-xl-table-cell">{{ $element->created }}</td>
                <td class="d-none d-lg-table-cell">{{ $element->type->name ?? 'No Type' }}</td>
                <td class="{{ Route::currentRouteName() === 'admin.' . $elementName . 's.index' ? '' : 'd-none' }}">
                    <div class="d-flex justify-content-center align-items-center">
                        <!-- Administration Actions -->
                        <a href="#" class="table-icon p-3 m-1 open-modal-info" data-bs-toggle="modal" data-bs-target="#staticBackdropInfo" data-title="{{ $element->title }}" data-description="{{ $element->description }}" data-created="{{ $element->created }}"  data-categories="{{ $element->type->name ?? 'No Type' }}">
                            <div class="icon-container">
                                <i class="fas fa-info-circle"></i>
                            </div>
                        </a>

                        <a href="{{ route('admin.' . $elementName . 's.edit', $element) }}" class="table-icon m-1 pe-2">
                            <div class="icon-container">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </a>
                        <form id="delete-form-{{ $element->id }}" action="{{ route('admin.' . $elementName . 's.destroy', $element->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-table table-icon" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('partials.modal-delete')
