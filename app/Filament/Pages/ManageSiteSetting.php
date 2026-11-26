<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSiteSetting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Site Settings';
    protected static ?string $title = 'Site Settings';
    protected static ?int $navigationSort = 100;

    protected static string $view = 'filament.pages.manage-site-setting';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(SiteSetting::first()?->toArray() ?? []);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Situs')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')->required(),
                        Forms\Components\TextInput::make('site_tagline'),
                        Forms\Components\FileUpload::make('logo')
                            ->image()
                            ->directory('site'),
                        Forms\Components\FileUpload::make('favicon')
                            ->image()
                            ->directory('site')
                            ->helperText('Disarankan PNG persegi, minimal 64x64'),
                        Forms\Components\ColorPicker::make('primary_color'),
                        Forms\Components\TextInput::make('footer_text')
                            ->placeholder('© 2026 Nama Kamu. All rights reserved.'),
                    ])->columns(2),

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->maxLength(60)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('meta_description')
                            ->maxLength(160)
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('meta_keywords')
                            ->helperText('Pisahkan dengan koma'),
                        Forms\Components\FileUpload::make('og_image')
                            ->label('Gambar saat dibagikan (OG Image)')
                            ->image()
                            ->directory('site')
                            ->helperText('Disarankan 1200x630 px'),
                    ])->columns(2),

                Forms\Components\Section::make('Lainnya')
                    ->schema([
                        Forms\Components\TextInput::make('google_analytics_id')
                            ->placeholder('G-XXXXXXXXXX'),
                        Forms\Components\Toggle::make('maintenance_mode')
                            ->helperText('Kalau aktif, frontend bisa menampilkan halaman "segera hadir"'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        SiteSetting::firstOrNew()->fill($data)->save();

        Notification::make()
            ->success()
            ->title('Pengaturan berhasil disimpan')
            ->send();
    }
}