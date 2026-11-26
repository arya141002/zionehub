<?php

namespace App\Filament\Pages;

use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Profile';
    protected static ?string $title = 'Profile';
    protected static ?int $navigationSort = -1;

    protected static string $view = 'filament.pages.manage-profile';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Profile::first()?->toArray() ?? []);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\TextInput::make('headline')
                            ->required()
                            ->placeholder('Contoh: Full Stack Developer'),
                        Forms\Components\TextInput::make('tagline')
                            ->maxLength(255)
                            ->helperText('Satu kalimat singkat untuk bagian hero')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_open_to_work')
                            ->label('Open to work'),
                    ])->columns(2),

                Forms\Components\Section::make('Tentang Saya')
                    ->schema([
                        Forms\Components\RichEditor::make('about')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Media & Dokumen')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->image()
                            ->avatar()
                            ->imageEditor()
                            ->directory('profile'),
                        Forms\Components\FileUpload::make('cv_file')
                            ->label('CV')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('profile'),
                    ])->columns(2),

                Forms\Components\Section::make('Kontak')
                    ->schema([
                        Forms\Components\TextInput::make('email')->email(),
                        Forms\Components\TextInput::make('phone')->tel(),
                        Forms\Components\TextInput::make('location')
                            ->placeholder('Contoh: Gresik, Jawa Timur'),
                    ])->columns(3),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $profile = Profile::firstOrNew();
        $profile->fill($data)->save();

        Notification::make()
            ->success()
            ->title('Profil berhasil disimpan')
            ->send();
    }
}