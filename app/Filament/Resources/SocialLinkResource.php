<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialLinkResource\Pages;
use App\Models\SocialLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SocialLinkResource extends Resource
{
    protected static ?string $model = SocialLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $navigationLabel = 'Social Links';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('platform')
                ->options([
                    'github' => 'GitHub',
                    'linkedin' => 'LinkedIn',
                    'instagram' => 'Instagram',
                    'twitter' => 'X / Twitter',
                    'youtube' => 'YouTube',
                    'whatsapp' => 'WhatsApp',
                    'email' => 'Email',
                    'website' => 'Website',
                    'other' => 'Lainnya',
                ])
                ->required()
                ->searchable(),
            Forms\Components\TextInput::make('label')
                ->placeholder('Contoh: @username')
                ->helperText('Teks yang ditampilkan di web (opsional)'),
            Forms\Components\TextInput::make('url')
                ->required()
                ->helperText('Untuk email: mailto:nama@email.com. Untuk WhatsApp: https://wa.me/628xxxxxxxxxx'),
            Forms\Components\TextInput::make('icon')
                ->helperText('Opsional. Kalau kosong, frontend bisa memakai ikon sesuai platform'),
            Forms\Components\Toggle::make('is_published')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('platform')->badge()->searchable(),
                Tables\Columns\TextColumn::make('label'),
                Tables\Columns\TextColumn::make('url')->limit(40),
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
            'index' => Pages\ListSocialLinks::route('/'),
            'create' => Pages\CreateSocialLink::route('/create'),
            'edit' => Pages\EditSocialLink::route('/{record}/edit'),
        ];
    }
}