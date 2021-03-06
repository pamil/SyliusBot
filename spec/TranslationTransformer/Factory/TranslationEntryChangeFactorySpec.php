<?php

namespace spec\SyliusBot\TranslationTransformer\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SyliusBot\TranslationTransformer\Factory\TranslationEntryChangeFactory;
use SyliusBot\TranslationTransformer\Factory\TranslationEntryChangeFactoryInterface;
use SyliusBot\TranslationTransformer\Factory\TranslationEntryFactoryInterface;
use SyliusBot\TranslationTransformer\Model\TranslationEntryChangeInterface;
use SyliusBot\TranslationTransformer\Model\TranslationEntryInterface;

/**
 * @mixin TranslationEntryChangeFactory
 *
 * @author Kamil Kokot <kamil.kokot@lakion.com>
 */
class TranslationEntryChangeFactorySpec extends ObjectBehavior
{
    function let(TranslationEntryFactoryInterface $translationEntryFactory)
    {
        $this->beConstructedWith($translationEntryFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SyliusBot\TranslationTransformer\Factory\TranslationEntryChangeFactory');
    }

    function it_implements_Translation_Entry_Change_Factory_interface()
    {
        $this->shouldImplement(TranslationEntryChangeFactoryInterface::class);
    }

    function it_creates_Translation_Entry_Change(
        TranslationEntryInterface $oldTranslationEntry,
        TranslationEntryInterface $newTranslationEntry,
        TranslationEntryChangeInterface $translationEntryChange
    ) {
        $translationEntryChange->getOldTranslationEntry()->willReturn($oldTranslationEntry);
        $translationEntryChange->getNewTranslationEntry()->willReturn($newTranslationEntry);

        $this->create($oldTranslationEntry, $newTranslationEntry)->shouldBeSameAs($translationEntryChange);
    }

    public function getMatchers()
    {
        return [
            'beSameAs' => function ($subject, $expected) {
                return null !== $subject
                    && $subject->getOldTranslationEntry() === $expected->getOldTranslationEntry()
                    && $subject->getNewTranslationEntry() === $expected->getNewTranslationEntry()
                ;
            }
        ];
    }
}
