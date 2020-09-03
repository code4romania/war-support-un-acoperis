@formField('input', [
    'name' => 'title',
    'label' => 'Title',
    'required' => true,
    'maxlength' => 100
])
@formField('browser', [
    'label' => 'Partners',
    'max' => 4,
    'required' => true,
    'name' => 'partners',
    'moduleName' => 'partners'
])
