<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('position')
                ->placeholder('Contoh: Project Manager'),
            Forms\Components\TextInput::make('company'),
            Forms\Components\Select::make('rating')
                ->options([
                    1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5',
                ])
                ->helperText('Opsional'),
            Forms\Components\Textarea::make('content')
                ->required()
                ->rows(5)
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('photo')
                ->image()
                ->avatar()
                ->imageEditor()
                ->directory('testimonials'),
            Forms\Components\TextInput::make('source_url')
                ->url()
                ->helperText('Opsional, misalnya link rekomendasi LinkedIn'),
            Forms\Components\Toggle::make('is_published')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')->circular(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('company')->searchable(),
                Tables\Columns\TextColumn::make('content')->limit(50),
                Tables\Columns\TextColumn::make('rating')->placeholder('-'),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}