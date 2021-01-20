<?php

namespace App\Http\Livewire;

use App\Page;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class PageContent extends Component
{

    use WithFileUploads;

    public $page;

    /** @var int $pageId */
    public $pageId;

    /** @var string $pageTitle_en */
    public $pageTitle_en;

    /** @var string $pageTitle_ru */
    public $pageTitle_ru;

    /** @var string $pageTitle_hy */
    public $pageTitle_hy;

    /** @var string $pageDescription_en */
    public $pageDescription_en;

    /** @var string $pageDescription_ru */
    public $pageDescription_ru;

    /** @var string $pageDescription_hy */
    public $pageDescription_hy;

    /** @var int $buttonType */
    public $buttonType = 0;

    /** @var string $url */
    public $url;

    /** @var string $image */
    public $image;

    /** @var string $buttonText_en */
    public $buttonText_en;

    /** @var string $buttonText_ru */
    public $buttonText_ru;

    /** @var string $buttonText_hy */
    public $buttonText_hy;

    /** @var array $inputs */
    public $inputs = [];

    protected $rules = [
        'inputs.*.pageTitle_*' => ['required'],
        'inputs.*.buttonText_*' => ['required'],
    ];

    public function mount($page)
    {
        $pageContents = \App\PageContent::where('page_id', $page->id)->get();

        if (!$pageContents->isEmpty()) {
            foreach ($pageContents as $key => $content) {
                $this->inputs[$key]['pageId'] = $content->id;

                $this->inputs[$key]['pageTitle_en'] = $content->translate('en')->title;
                $this->inputs[$key]['pageTitle_ru'] = $content->translate('ru')->title;
                $this->inputs[$key]['pageTitle_hy'] = $content->translate('hy')->title;

                $this->inputs[$key]['pageDescription_en'] = $content->translate('en')->description;
                $this->inputs[$key]['pageDescription_ru'] = $content->translate('ru')->description;
                $this->inputs[$key]['pageDescription_hy'] = $content->translate('hy')->description;

                $this->inputs[$key]['buttonText_en'] = $content->translate('en')->link_title;
                $this->inputs[$key]['buttonText_ru'] = $content->translate('ru')->link_title;
                $this->inputs[$key]['buttonText_hy'] = $content->translate('hy')->link_title;

                $this->inputs[$key]['buttonType'] = $content->button_type;
                $this->inputs[$key]['url'] = $content->url;
                $this->inputs[$key]['image'] = $content->image;
            }
        }

    }

    public function add()
    {
        $this->inputs[] = [];
    }

    public function removeImage($imageId)
    {
        $content = \App\PageContent::find($imageId);
        if (file_exists(asset('storage/page-content/' . $content->image))) {
            unlink(storage_path('app/public/page-content/' . $content->image));
        }

        $content->image = null;
        $content->save();

        $this->emit('show-toast', __('messages.page_content_image_removed'), 'success');
    }

    public function updatePageContent()
    {
        $this->validate();

        foreach ($this->inputs as $key => $value) {

            $translatedFields = [
                'url' => !empty($value['url'])? $value['url'] : null,
                'button_type' => !empty($value['buttonType']) ? $value['buttonType'] : 0,
                'en' => [
                    'title' => $value['pageTitle_en'],
                    'description' => !empty($value['pageDescription_en'])? $value['pageDescription_en'] : null,
                    'link_title' => !empty($value['buttonText_en'])? $value['buttonText_en'] : null,
                ],
                'ru' => [
                    'title' => $value['pageTitle_ru'],
                    'description' => !empty($value['pageDescription_ru'])? $value['pageDescription_ru'] : null,
                    'link_title' => !empty($value['buttonText_ru'])? $value['buttonText_ru'] : null,
                ],
                'hy' => [
                    'title' => $value['pageTitle_hy'],
                    'description' => !empty($value['pageDescription_hy'])? $value['pageDescription_hy'] : null,
                    'link_title' => !empty($value['buttonText_hy'])? $value['buttonText_hy'] : null,
                ]
            ];

            if ($value['image']) {

                $this->rules = array_merge(['inputs.*.image' => ['image', 'max:1024']]);

                // Remove existing file
                if (!empty($pageContent->image)) {
                    unlink(storage_path('app/public/page-content/' . $pageContent->image));
                }

                $fileName = time() . '.' . $this->inputs[$key]['image']->extension();
                $destinationPath = storage_path('app/public/page-content');

                // Create directory
                File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

                $img = Image::make($this->inputs[$key]['image']->path());
                $img->save($destinationPath.'/' . $fileName, 90);

                $translatedFields['image'] = $fileName;
            }

            if (!empty($this->pageId)) {
                $this->page->pageContent()->create($translatedFields);
            } else {
                $pageContent = \App\PageContent::find($value['pageId']);
                $pageContent->update($translatedFields);
            }
        }

        return redirect()->to('admin/page/' . $this->page->id . '/edit');
    }

    public function render()
    {
        return view('livewire.page-content', ['page' => $this->page]);
    }
}
