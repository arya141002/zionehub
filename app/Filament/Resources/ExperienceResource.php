<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('company')->required(),
            Forms\Components\TextInput::make('position')->required(),
            Forms\Components\Select::make('type')
                ->options([
                    'full-time' => 'Full-time',
                    'part-time' => 'Part-time',
                    'internship' => 'Magang',
                    'freelance' => 'Freelance',
                    'contract' => 'Kontrak',
                ])
                ->default('full-time')
                ->required(),
            Forms\Components\TextInput::make('location'),
            Forms\Components\TextInput::make('company_url')->url(),
            Forms\Components\DatePicker::make('start_date')->required(),
            Forms\Components\DatePicker::make('end_date')
                ->helperText('Kosongkan jika masih bekerja di sini'),
            Forms\Components\TagsInput::make('tech_stack')
                ->placeholder('Ketik lalu tekan Enter')
                ->columnSpanFull(),
            Forms\Components\Textarea::make('description')
                ->rows(5)
                ->columnSpanFull(),
            Forms\Components\Toggle::make('is_published')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company')->searchable(),
                Tables\Columns\TextColumn::make('position')->searchable(),
                Tables\Columns\TextColumn::make('type')->badge(),
                Tables\Columns\TextColumn::make('start_date')->date('M Y'),
                Tables\Columns\TextColumn::make('end_date')->date('M Y')->placeholder('Sekarang'),
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}