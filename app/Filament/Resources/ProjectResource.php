<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
            Forms\Components\TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('summary')
                ->maxLength(255)
                ->columnSpanFull(),
            Forms\Components\RichEditor::make('description')
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('thumbnail')
                ->image()
                ->directory('projects/thumbnails')
                ->imageEditor(),
            Forms\Components\FileUpload::make('gallery')
                ->image()
                ->multiple()
                ->reorderable()
                ->directory('projects/gallery'),
            Forms\Components\TextInput::make('demo_url')->url(),
            Forms\Components\TextInput::make('repo_url')->url(),
            Forms\Components\TagsInput::make('tech_stack')
                ->placeholder('Ketik lalu tekan Enter')
                ->columnSpanFull(),
            Forms\Components\DatePicker::make('project_date'),
            Forms\Components\Toggle::make('is_featured')
                ->helperText('Tampilkan di halaman depan'),
            Forms\Components\Toggle::make('is_published')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('tech_stack')->badge(),
                Tables\Columns\TextColumn::make('project_date')->date('M Y'),
                Tables\Columns\ToggleColumn::make('is_featured'),
                Tables\Columns\ToggleColumn::make('is_published'),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}