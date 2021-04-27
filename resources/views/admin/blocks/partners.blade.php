@formField('input', [
    'name' => 'title',
    'label' => 'Title',
    'required' => true,
    'maxlength' => 100,
    'translated' => true,
])
@formField('browser', [
    'label' => 'Partners',
    'max' => 1000,
    'required' => true,
    'name' => 'partners',
    'moduleName' => 'partners'
])
